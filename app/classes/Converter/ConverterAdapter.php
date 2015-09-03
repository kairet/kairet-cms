<?php
namespace KCMS\Converter;

use Symfony\Component\HttpFoundation\Request;

/**
 * Adapter-class for {@see AbstractConverter} returning null for all functions by default
 *
 * @package KCMS\Converter
 */
class ConverterAdapter extends AbstractConverter
{
    public function convertFromId($id)
    {
        return null;
    }

    public function convertFromRequestBody($null, Request $request)
    {
        return null;
    }
}
