<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\WebVisitor;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent', '');

        // Abaikan pencatatan jika user-agent diidentifikasi sebagai bot/crawler umum
        if (preg_match('/bot|crawl|spider|slurp|screenshot/i', $userAgent)) {
            return $next($request);
        }

        // Logika deteksi tipe perangkat dasar secara native
        $deviceType = 'Desktop';
        if (preg_match('/tablet|ipad|playbook|silk/i', $userAgent)) {
            $deviceType = 'Tablet';
        } elseif (preg_match('/mobile|phone|iphone|ipod|blackberry|android|iemobile/i', $userAgent)) {
            $deviceType = 'Mobile';
        }

        // Simpan log kunjungan ke database
        WebVisitor::create([
            'ip_address' => $request->ip(),
            'device_type' => $deviceType,
            'browser' => $this->getBrowserName($userAgent),
            'platform' => $this->getPlatformName($userAgent),
        ]);

        return $next($request);
    }

    private function getBrowserName($userAgent) {
        if (preg_match('/msie/i', $userAgent) && !preg_match('/opera/i', $userAgent)) return 'MSIE';
        if (preg_match('/firefox/i', $userAgent)) return 'Firefox';
        if (preg_match('/chrome/i', $userAgent)) return 'Chrome';
        if (preg_match('/safari/i', $userAgent)) return 'Safari';
        if (preg_match('/opera/i', $userAgent)) return 'Opera';
        return 'Other';
    }

    private function getPlatformName($userAgent) {
        if (preg_match('/windows|win32/i', $userAgent)) return 'Windows';
        if (preg_match('/macintosh|mac os x/i', $userAgent)) return 'Mac OS';
        if (preg_match('/linux/i', $userAgent)) return 'Linux';
        if (preg_match('/android/i', $userAgent)) return 'Android';
        if (preg_match('/iphone|ipad|ipod/i', $userAgent)) return 'iOS';
        return 'Other';
    }
}