<?php
namespace Utils;

use Knp\Snappy\Pdf;

class PDFRenderer extends \Prefab
{

    private $opts;
    private $outputPath;
    private $renderer;

    public function __construct($opts)
    {
        $this->opts = $opts;

        if (!file_exists($this->opts['outputPath']) && trim($this->opts['outputPath']) != '') {
            mkdir($this->opts['outputPath']);
        }

        $this->outputPath = realpath($this->opts['outputPath']);

    }

    public function render($html, $filename, $isLandscape = false)
    {
        $renderer = $this->getRenderer();

        if ($isLandscape) {
            $renderer->setOption('zoom', '0.890');
            $renderer->setOption('orientation', 'landscape');
        }

        $file = $this->outputPath . '/' . time() . uniqid('', true) . '_' .$filename;

        $renderer->generateFromHtml($html, $file);

        return realpath($file);
    }

    private function getRenderer()
    {
        if (!$this->renderer) {
            $this->renderer = new Pdf;
            $this->renderer->setBinary($this->opts['binPath']);
            $this->renderer->setOptions($this->opts['defaultOptions']);
        }

        return $this->renderer;
    }



}
