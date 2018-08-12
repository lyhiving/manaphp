<?php
namespace ManaPHP;

interface DotenvInterface
{
    /**
     * @param string $file
     *
     * @return static
     */
    public function load($file = '@root/.env');

    /**
     * @param array $lines
     *
     * @return array
     */
    public function parse($lines);

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed|array
     */
    public function getEnv($key, $default = null);
}