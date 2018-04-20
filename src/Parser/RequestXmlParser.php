<?php

namespace Swoft\Http\Server\Parser;

use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Helper\XmlHelper;
use Swoft\Http\Message\Server\Request;

/**
 * The xml parser of request
 * @Bean()
 */
class RequestXmlParser implements RequestParserInterface
{
    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ServerRequestInterface
     * @throws \RuntimeException
     */
    public function parse(ServerRequestInterface $request): ServerRequestInterface
    {
        if ($request instanceof Request) {
            $bodyStream = $request->getBody();
            $bodyContent = $bodyStream->getContents();
            try {
                $bodyParams = XmlHelper::decode($bodyContent);
            } catch (\Exception $e) {
                $bodyParams = $bodyContent;
            }
            return $request->withBodyParams($bodyParams);
        }

        return $request;
    }
}