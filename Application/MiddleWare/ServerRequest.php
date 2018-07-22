<?php
namespace Application\MiddleWare;

use Psr\Http\Message\ServerRequestInterface;

class ServerRequest extends Request implements ServerRequestInterface
{

    public $serverParams;
    public $cookies;
    public $queryParams;
    public $contentType;
    public $parsedBody;
    public $attributes;
    public $method;
    public $uploadedFileInfo;        // typically $_FILES
    public $uploadedFileObjs;        // UploadFileInterface instances

    public function initialize()
    {
        $params = $this->getServerParams();
        $this->getCookieParams();
        $this->getQueryParams();
        $this->getUploadedFiles();
        $this->getRequestMethod();
        $this->getContentType();
        $this->getParsedBody();
        return $this->withRequestTarget($params['REQUEST_URI']);
    }

    public function getServerParams()
    {
        if (!$this->serverParams) {
            $this->serverParams = $_SERVER;
        }
        return $this->serverParams;
    }

    public function getCookieParams()
    {
        if (!$this->cookies) {
            $this->cookies = $_COOKIE;
        }
        return $this->cookies;
    }

    public function withCookieParams(array $cookies)
    {
        array_merge($this->getCookieParams(), $cookies);
        return $this;
    }

    public function getQueryParams()
    {
        if (!$this->queryParams) {
            $this->queryParams = $_GET;
        }
        return $this->queryParams;
    }

    public function withQueryParams(array $query)
    {
        array_merge($this->getQueryParams(), $query);
        return $this;
    }

    public function getUploadedFileInfo()
    {
        if (!$this->uploadedFileInfo) {
            $this->uploadedFileInfo = isset($_FILES) ? $_FILES : array();
        }
        return $this->uploadedFileInfo;
    }

    public function getUploadedFiles()
    {
        if (!$this->uploadedFileObjs) {
            foreach ($this->getUploadedFileInfo() as $field => $value) {
                $this->uploadedFileObjs[$field] = new UploadedFile($field, $value);
            }
        }
        return $this->uploadedFileObjs;
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        if (!count($uploadedFiles)) {
            throw new Exception(Constant::ERROR_NO_UPLOADED_FILES);
        }
        foreach ($uploadedFiles as $fileObj) {
            if (!$fileObj instanceof UploadedFileInterface) {
                throw new Exception(Constant::ERROR_INVALID_UPLOADED);
            }
        }
        $this->uploadedFileObjs = $uploadedFiles;
    }

    public function getRequestMethod()
    {
        $params = $this->getServerParams();
        $method = isset($params['REQUEST_METHOD']) ? $params['REQUEST_METHOD'] : '';
        $this->method = strtolower($method);
        return $this->method;
    }

    public function getContentType()
    {
        if (!$this->contentType) {
            $params = $this->getServerParams();
            $this->contentType = isset($params['CONTENT_TYPE']) ? $params['CONTENT_TYPE'] : '';
            $this->contentType = strtolower($this->contentType);
        }
        return $this->contentType;
    }

    public function getParsedBody()
    {
        if (!$this->parsedBody) {
            if (($this->getContentType() == Constants::CONTENT_TYPE_FORM_ENCODED
                || $this->getContentType() == Constants::CONTENT_TYPE_MULTI_FORM)
                && $this->getRequestMethod() == Constants::METHOD_POST)
            {
                $this->parsedBody = $_POST;
            } elseif ($this->getContentType() == Constants::CONTENT_TYPE_JSON
                      || $this->getContentType() == Constants::CONTENT_TYPE_HAL_JSON)
            {
                ini_set("allow_url_fopen", true);
                $this->parsedBody = unserialize(file_get_contents('php://stdin'));
            } elseif (!empty($_REQUEST)) {
                $this->parsedBody = $_REQUEST;
            } else {
                ini_set("allow_url_fopen", true);
                $this->parsedBody = file_get_contents('php://stdin');
            }
        }
        return $this->parsedBody;
    }

    public function withParsedBody($data)
    {
        $this->parsedBody = $data;
        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($name, $default = NULL)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : $default;
    }

    public function withAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function withoutAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            unset($this->attributes[$name]);
        }
        return $this;
    }

}
