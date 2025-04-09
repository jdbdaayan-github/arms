<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class CaptchaController extends Controller
{
    // This method will generate and return the CAPTCHA image as base64
    public function generate()
    {
        // Define CAPTCHA configurations
        $captcha_config = [
            'img_width' => 350,
            'img_height' => 50,
            'word_length' => 6,
            'font_size' => 24,
            'expiration' => 3600,
        ];

        // Generate new CAPTCHA word
        $captcha_word = $this->generate_captcha_word($captcha_config['word_length']);

        // Create CAPTCHA image and get base64 representation
        $captcha_base64 = $this->create_captcha_image($captcha_word, $captcha_config);

        // Store CAPTCHA word in session
        session()->set([
            'captcha_word' => $captcha_word,
        ]);

        // Return the base64 image string
        return $captcha_base64;
    }

    // Function to generate the CAPTCHA word
    private function generate_captcha_word($length = 6)
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
        $captcha_word = '';

        for ($i = 0; $i < $length; $i++) {
            $captcha_word .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $captcha_word;
    }

    // Create CAPTCHA image and return base64 encoded image
    private function create_captcha_image($captcha_word, $config)
    {
        $image = imagecreatetruecolor($config['img_width'], $config['img_height']);

        $light_blue = imagecolorallocate($image, 240, 248, 255);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $line_color = imagecolorallocate($image, 160, 206, 232);

        imagefill($image, 0, 0, $light_blue);

        // Adding noise lines
        for ($i = 0; $i < 50; $i++) {
            imageline($image, rand(0, $config['img_width']), rand(0, $config['img_height']), rand(0, $config['img_width']), rand(0, $config['img_height']), $line_color);
        }

        // Add text to the image
        $font_path = './assets/fonts/arial.ttf'; // Make sure the font path is correct
        $x = 10;
        for ($i = 0; $i < strlen($captcha_word); $i++) {
            $angle = rand(-10, 10);
            $y = rand(30, 40);
            imagettftext($image, $config['font_size'], $angle, $x, $y, $text_color, $font_path, $captcha_word[$i]);
            $x += $config['font_size'] + 2;
        }

        // Capture the image to a variable (no file save)
        ob_start();
        imagepng($image);
        $image_data = ob_get_contents();
        ob_end_clean();

        imagedestroy($image);

        // Return the base64 encoded image
        return 'data:image/png;base64,' . base64_encode($image_data);
    }
}
