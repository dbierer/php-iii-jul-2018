<?php
declare(strict_types=1);

//*** DB: added 2018-07-27
namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\ {JsonResponse, HtmlResponse, TextResponse};

class StrategyHandler implements RequestHandlerInterface
{
    const DEFAULT_ACCEPT = 'text/html';
    protected $accept;
    protected $headers;
    protected $params;
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $this->request = $request;
        $this->headers = $request->getHeaders();
        $this->params  = $request->getServerParams();
        $this->accept  = $this->breakdownAccept();
        switch (TRUE) {
            case (stripos($this->accept, 'html') !== FALSE) :
                $response = $this->getHtml();
                break;
            case (stripos($this->accept, 'json') !== FALSE) :
                $response = $this->getJson();
                break;
            default :
                $response = $this->getText();
        }
        return $response;
    }
    protected function breakdownAccept()
    {
        if (isset($this->headers['accept'][0])) {
            $parts = explode(';', $this->headers['accept'][0])[0];
            $accept = explode(',', $parts)[0] ?? self::DEFAULT_ACCEPT;
        } else {
            $accept = self::DEFAULT_ACCEPT;
        }
        return $accept;
    }
    protected function getJson()
    {
        return new JsonResponse(['headers' => $this->headers, 'params' => $this->params]);
    }
    protected function getHtml()
    {
        $html = '<h1>Headers</h1>' . PHP_EOL;
        $html .= '<table>' . PHP_EOL;
        foreach ($this->headers as $key => $value) {
            $html .= '<tr><th style="text-align:right;">' . $key . '</th>';
            $html .= '<td style="width:10%">&nbsp;</td>';
            $html .= '<td>' . implode(',', $value) . '</td></tr>' . PHP_EOL;
        }
        $html .= '</table>' . PHP_EOL;
        $html .= '<h1>Params</h1>' . PHP_EOL;
        $html .= '<table>' . PHP_EOL;
        foreach ($this->params as $key => $value) {
            $html .= '<tr><th style="text-align:right;">' . htmlspecialchars($key) . '</th>';
            $html .= '<td style="width:10%">&nbsp;</td>';
            $html .= '<td>' . htmlspecialchars(var_export($value, TRUE)) . '</td></tr>' . PHP_EOL;
        }
        $html .= '</table>' . PHP_EOL;
        return new HtmlResponse($html);
    }
    protected function getText()
    {
        $text = 'Headers:' . PHP_EOL;
        foreach ($this->headers as $key => $value)
            $text .= sprintf('%20s : %40s' . PHP_EOL, $key, implode(',', $value));
        $text .= 'Params:' . PHP_EOL;
        foreach ($this->params as $key => $value)
            $text .= sprintf('%20s : %40s' . PHP_EOL, $key, $value);
        return new TextResponse($text);
    }
}
