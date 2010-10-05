<?php
/*
 * This file is part of the WebServiceBundle.
 *
 * (c) Christian Kerl <christian-kerl@web.de>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\WebServiceBundle\Soap;

use Symfony\Component\HttpFoundation\Request;

/**
 * SoapRequest.
 *
 * @author Christian Kerl <christian-kerl@web.de>
 */
class SoapRequest extends Request
{
    /**
     * @var string
     */
    protected $rawContent;

    /**
     * @var string
     */
    protected $soapAction;

    /**
     * @var unknown
     */
    protected $soapHeader;

    /**
     * @var unknown
     */
    protected $soapArguments;

    public function __construct($rawContent = null, array $query = null, array $attributes = null, array $cookies = null, array $server = null)
    {
        parent::__construct($query, null, $attributes, $cookies, null, $server);

        $this->rawContent = $rawContent != null ? $rawContent : $this->loadRawContent();
    }

    /**
     * Gets the SOAP XML content.
     *
     * @return string
     */
    public function getRawContent()
    {
        return $this->rawContent;
    }

    /**
     * Loads the plain HTTP POST data.
     *
     * @return string
     */
    protected function loadRawContent()
    {
        return isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents('php://input');
    }
}