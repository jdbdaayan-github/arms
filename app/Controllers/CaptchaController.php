<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CaptchaController extends BaseController
{
    public function generate()
    {

        $captcha_config = [
            'img_width' => 350,
            'img_height' => 50,
            'word_length' => 6,
            'font_size' => 24,
            'expiration' => 3600,
        ];

        $captcha_word = $this->generate_captcha_word($captcha_config['word_length']);

        $captcha_base64 = $this->create_captcha_image($captcha_word, $captcha_config);

        session()->set([
            'captcha_word' => $captcha_word,
        ]);

        return $captcha_base64;
    }

    private function generate_captcha_word($length = 6)
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
        $captcha_word = '';

        for ($i = 0; $i < $length; $i++) {
            $captcha_word .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $captcha_word;
    }

    private function create_captcha_image($captcha_word, $config)
    {
        $image = imagecreatetruecolor($config['img_width'], $config['img_height']);

        $light_blue = imagecolorallocate($image, 240, 248, 255);
        $text_color = imagecolorallocate($image, 20, 20, 20);
        $line_color = imagecolorallocate($image, 160, 206, 232);

        imagefill($image, 0, 0, $light_blue);

        $max_radius = max($config['img_width'], $config['img_height']) * 2.5;

        $centerX = rand(-$max_radius / 2, $config['img_width'] + $max_radius / 2);
        $centerY = rand(-$max_radius / 2, $config['img_height'] + $max_radius / 2);

        $num_radial_lines = 50;
        $num_circles = 100;

        for ($i = 0; $i < $num_radial_lines; $i++) {
            $angle = (2 * M_PI / $num_radial_lines) * $i;
            $x_end = $centerX + cos($angle) * $max_radius;
            $y_end = $centerY + sin($angle) * $max_radius;
            imageline($image, $centerX, $centerY, $x_end, $y_end, $line_color);
        }

        for ($j = 1; $j <= $num_circles; $j++) {
            $radius = ($max_radius / $num_circles) * $j;
            imagearc($image, $centerX, $centerY, $radius * 2, $radius * 2, 0, 360, $line_color);
        }

        $font_path = './assets/fonts/arial.ttf';
        $x = 10;
        for ($i = 0; $i < strlen($captcha_word); $i++) {
            $angle = rand(-10, 10);
            $y = rand(30, 40);
            imagettftext($image, $config['font_size'], $angle, $x, $y, $text_color, $font_path, $captcha_word[$i]);
            $x += $config['font_size'] + 2;
        }

        ob_start();
        imagepng($image);
        $image_data = ob_get_contents();
        ob_end_clean();

        imagedestroy($image);

        return 'data:image/png;base64,' . base64_encode($image_data);
    }
}
