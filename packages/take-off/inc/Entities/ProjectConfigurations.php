<?php

namespace LaunchpadTakeOff\Entities;

use LaunchpadTakeOff\ObjectValues\ConstantPrefix;
use LaunchpadTakeOff\ObjectValues\Folder;
use LaunchpadTakeOff\ObjectValues\HookPrefix;
use LaunchpadTakeOff\ObjectValues\PS4Namespace;
use LaunchpadTakeOff\ObjectValues\TranslationKey;
use LaunchpadTakeOff\ObjectValues\URL;
use LaunchpadTakeOff\ObjectValues\Version;
use LaunchpadTakeOff\ObjectValues\WordPressKey;

class ProjectConfigurations
{
    /**
     * @var PS4Namespace
     */
    protected $namespace;

    /**
     * @var PS4Namespace
     */
    protected $test_namespace;

    /**
     * @var Folder
     */
    protected $code_folder;

    /**
     * @var Folder
     */
    protected $test_folder;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var URL
     */
    protected $url;

    /**
     * @var ConstantPrefix
     */
    protected $constant_prefix;

    /**
     * @var HookPrefix
     */
    protected $hook_prefix;

    /**
     * @var TranslationKey
     */
    protected $translation_key;

    /**
     * @var WordPressKey
     */
    protected $wordpress_key;

    /**
     * @var Version
     */
    protected $min_php;

    /**
     * @var Version
     */
    protected $min_wp;

    /**
     * @param PS4Namespace $namespace
     * @param PS4Namespace $test_namespace
     * @param Folder $code_folder
     * @param Folder $test_folder
     * @param string $name
     * @param string $description
     * @param string $author
     * @param URL $url
     * @param Version $min_php
     * @param Version $min_wp
     */
    public function __construct(Folder $code_folder, Folder $test_folder, string $name, string $description = '', string $author = '', URL $url = null, Version $min_php = null, Version $min_wp = null)
    {
        $this->code_folder = $code_folder;
        $this->test_folder = $test_folder;
        $this->name = $name;
        $this->description = $description;
        $this->author = $author;
        $this->url = $url;
        $this->min_php = $min_php;
        $this->min_wp = $min_wp;
        $this->namespace = new PS4Namespace($this->generate_namespace($name));
        $this->test_namespace = new PS4Namespace( $this->namespace->get_value() . '\\Tests');
        $this->wordpress_key = new WordPressKey($this->generate_wp_key($name));
        $this->constant_prefix = new ConstantPrefix($this->generate_constant_prefix($this->wordpress_key));
        $this->hook_prefix = new HookPrefix($this->generate_function_prefix($this->wordpress_key));
        $this->translation_key = new TranslationKey($this->generate_translation_key($this->wordpress_key));
    }

    /**
     * @return PS4Namespace
     */
    public function get_namespace(): PS4Namespace
    {
        return $this->namespace;
    }

    /**
     * @return PS4Namespace
     */
    public function get_test_namespace(): PS4Namespace
    {
        return $this->test_namespace;
    }

    /**
     * @return Folder
     */
    public function get_code_folder(): Folder
    {
        return $this->code_folder;
    }

    /**
     * @return Folder
     */
    public function get_test_folder(): Folder
    {
        return $this->test_folder;
    }

    /**
     * @return string
     */
    public function get_name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function get_description(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function get_author(): string
    {
        return $this->author;
    }

    /**
     * @return URL
     */
    public function get_url(): ?URL
    {
        return $this->url;
    }

    /**
     * @return ConstantPrefix
     */
    public function get_constant_prefix(): ConstantPrefix
    {
        return $this->constant_prefix;
    }

    /**
     * @return HookPrefix
     */
    public function get_hook_prefix(): HookPrefix
    {
        return $this->hook_prefix;
    }

    /**
     * @return TranslationKey
     */
    public function get_translation_key(): TranslationKey
    {
        return $this->translation_key;
    }

    /**
     * @return WordPressKey
     */
    public function get_wordpress_key(): WordPressKey
    {
        return $this->wordpress_key;
    }

    /**
     * @return Version
     */
    public function get_min_php(): ?Version
    {
        return $this->min_php;
    }

    /**
     * @return Version
     */
    public function get_min_wp(): ?Version
    {
        return $this->min_wp;
    }

    protected function generate_namespace(string $name) {
        $name = mb_convert_encoding($name, "ASCII", "UTF-8");
        return str_replace(' ', '', preg_replace_callback('/\b\w/', function($match){
            return strtoupper($match[0]);
        }, $name) );
    }

    protected function generate_wp_key(string $name) {
        $name = mb_convert_encoding($name, "ASCII", "UTF-8");
        return strtolower(str_replace(" ", "-", $name));
    }

    protected function generate_constant_prefix(WordPressKey $wp_prefix) {
        return str_replace('-', '_', strtoupper($wp_prefix->get_value())) . '_';
    }

    protected function generate_translation_key(WordPressKey $wp_prefix) {
        return str_replace('-', '', $wp_prefix->get_value());
    }

    protected function generate_function_prefix(WordPressKey $wp_prefix) {
        return str_replace('-', '_', $wp_prefix->get_value()) . '_';
    }
}
