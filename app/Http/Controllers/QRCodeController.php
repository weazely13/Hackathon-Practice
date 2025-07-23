<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class QRCodeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard'); // blade file below
    }

    public function generate(Request $request)
    {
        $user = Auth::user();

        $data = [
            'business_name' => $user->name,
            'business_ID' => $user->id,
        ];

        $response = Http::asForm()->post('http://127.0.0.1:5000/qr-generate', $data);

        if (!$response->ok()) {
            return back()->with('error', 'Failed to generate QR code.');
        }

        $json = $response->json();

        if (!isset($json['image'])) {
            return back()->with('error', 'Invalid response from QR generator.');
        }

        session(['qrImageUrl' => $json['image']]);
        return back(); // or redirect()->route('dashboard');
    }

}