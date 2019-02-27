<?php

namespace Industrious\Flash\Composers;

use Illuminate\Contracts\View\View;


abstract class Composer
{
    /** @var array */
    protected static $data = [];

    /** Compose a view.
     *
     * @param \Illuminate\Contracts\View\View $view
     */
    public function compose(View $view): void
    {
        $name = $view->getName();
        $key = sprintf('%s:%s', get_class($this), $name);
        if (! isset(static::$data[$key])) {
            static::$data[$key] = $this->data($name, $view->getData());
        }

        $view->with(static::$data[$key]);
    }

    /** Get the composed data.
     *
     * @param string $view
     * @param array $data
     *
     * @return array
     */
    abstract protected function data(string $view, array $data): array;
}
