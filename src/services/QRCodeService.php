<?php
/**
 * QRCode plugin for Craft CMS 4.x
 *
 * Generate a QR code
 *
 * @link      https://webdna.co.uk
 * @copyright Copyright (c) 2019 webdna
 */

namespace webdna\qrcode\services;

use webdna\qrcode\QRCode as Plugin;

use Endroid\QrCode\QrCode;

use Twig\Markup;

use Craft;
use craft\base\Component;
use craft\helpers\Template;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

/**
 * @author    webdna
 * @package   QRCode
 * @since     0.0.1
 */
class QRCodeService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @param mixed $data
     * @param ?int $size
     * @return Markup
     */
    public function generate(mixed $data, ?int $size = null): Markup
    {
        if (gettype($data) == 'array') {
            $data = json_encode($data);
        }

        $generator = new QrCode($data);
        if ($size) {
            $generator->setSize($size);
        }

        
$writer = new PngWriter();

// Create QR code
$qrCode = QrCode::create($data)
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
    ->setSize($size)
    ->setMargin(10)
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())


        return Template::raw( $writer->write($qrCode) );
    }
}
