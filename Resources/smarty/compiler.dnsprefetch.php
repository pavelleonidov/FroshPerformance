<?php

/**
 * Specifies a file to be dns-prefetch using Link header
 *
 * Parameters known by $params
 * - path        : virtual path of the media file
 */
class Smarty_Compiler_Dnsprefetch extends Smarty_Internal_CompileBase
{
    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     *
     * @see Smarty_Internal_CompileBase
     */
    public $required_attributes = ['uri'];

    /**
     * Overwrite optional attributes
     *
     * @var array
     */
    public $optional_attributes = ['_any'];

    /**
     * @param array                                  $args
     * @param Smarty_Internal_SmartyTemplateCompiler $compiler
     *
     * @return string
     */
    public function compile($args, $compiler)
    {
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args);

        unset($_attr['nocache']);

        $options = $_attr;
        unset($options['uri']);

        return '<?php '
            . 'echo Shopware()->Container()->get(\'web_link_manager\')->dnsPrefetch(' . $_attr['uri'] . ', ' . var_export($options, true) . ') ?>';
    }
}
