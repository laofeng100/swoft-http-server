<?php

namespace Swoft\Http\Server\Middleware;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\App;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Server\AttributeEnum;
use Swoft\Http\Server\Router\HandlerAdapter;
use Swoft\Middleware\MiddlewareInterface;

/**
 * handler adapter
 *
 * @Bean()
 * @uses      HandlerAdapterMiddleware
 * @version   2017年11月25日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class HandlerAdapterMiddleware implements MiddlewareInterface
{
    /**
     * execute action
     *
     * @param \Psr\Http\Message\ServerRequestInterface     $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $httpHandler = $request->getAttribute(AttributeEnum::ROUTER_ATTRIBUTE);

        /* @var HandlerAdapter $handlerAdapter */
        $handlerAdapter = App::getBean('httpHandlerAdapter');
        $response       = $handlerAdapter->doHandler($request, $httpHandler);

        return $response;
    }
}
