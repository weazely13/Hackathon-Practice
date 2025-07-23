<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
</head>
<body>
    <h2>Generate QR Code</h2>

    <form method="POST" action="/generate-qr">
        @csrf
        <label>Business Name:</label>
        <input type="text" name="business_name" required><br><br>

        <label>Business ID:</label>
        <input type="text" name="business_ID" required><br><br>

        <button type="submit">Generate QR</button>
    </form>

    @if (isset($qrImage))
        <h3>QR Code:</h3>
        <img src="{{ $qrImage }}" alt="QR Code" />
    @endif

    @if (session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif
</body>
</html>
