#run this to download all the libraries, PYCHARM DAPAT 
#pip install Flask Pillow transformers torch better_profanity qrcode[pil]
#tapos ig run, magenerate ini ip address
#HA PYCHARM INI IG RUN

from flask import Flask, request, jsonify, send_file
from PIL import Image
from transformers import AutoProcessor, AutoModelForImageClassification
from better_profanity import profanity
import torch
import os
import tempfile
import qrcode
import random
import io
import base64

profanity.load_censor_words()
processor = AutoProcessor.from_pretrained("Falconsai/nsfw_image_detection")
model = AutoModelForImageClassification.from_pretrained("Falconsai/nsfw_image_detection")

app = Flask(__name__)

@app.route('/qr-generate', methods=['POST'])
def generate_qr():
    business_name = request.form.get('business_name')
    business_ID = request.form.get('business_ID')
    data = f"http://127.0.0.1:8000/{business_name}/{business_ID}"

    version = random.randint(1, 10)
    box_size = 10
    border = random.randint(1, 10)

    qr = qrcode.QRCode(
        version=version,
        box_size=box_size,
        border=border
    )

    qr.add_data(data)
    qr.make(fit=True)
    img = qr.make_image(fill="black", back_color="white")

    buffer = io.BytesIO()
    img.save(buffer, format="PNG")
    buffer.seek(0)
    img_base64 = base64.b64encode(buffer.read()).decode('utf-8')
    return jsonify({'image': f"data:image/png;base64,{img_base64}"})

@app.route('/check-image', methods=['POST'])
def check_image():
    image_file = request.files.get('image')
    comment = request.form.get('comment', '').strip()

    if not comment and (image_file is None or image_file.filename == '' or image_file.read() == b''):
        return jsonify({'error': 'You must upload an image or enter a comment'}), 400

    if image_file:
        image_file.seek(0)

    is_nsfw = False
    scores = {}

    if image_file and image_file.filename != '':
        with tempfile.NamedTemporaryFile(delete=False, suffix=".jpg") as temp:
            image_file.save(temp.name)
            temp_path = temp.name

        try:
            with Image.open(temp_path).convert("RGB") as image:
                inputs = processor(images=image, return_tensors="pt")
                with torch.no_grad():
                    outputs = model(**inputs)
                    probs = torch.nn.functional.softmax(outputs.logits, dim=1)[0]

            scores = {model.config.id2label[i]: float(prob) for i, prob in enumerate(probs)}
            top_label = max(scores, key=scores.get)
            is_nsfw = top_label == "nsfw"
        finally:
            if os.path.exists(temp_path):
                os.remove(temp_path)

    is_profane = profanity.contains_profanity(comment) if comment else False

    if is_nsfw:
        return jsonify({
            'status': 'rejected',
            'reason': 'NSFW image detected',
            'scores': scores
        }), 200
    elif is_profane:
        return jsonify({
            'status': 'rejected',
            'reason': 'Inappropriate language in comment',
            'comment': comment
        }), 200
    else:
        return jsonify({
            'status': 'approved',
            'comment': comment,
            'scores': scores
        }), 200

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
