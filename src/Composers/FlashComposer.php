<?php

namespace Industrious\Flash\Composers;

use Industrious\Flash\Flash;
use Illuminate\Contracts\Session\Session;

class FlashComposer extends Composer
{
    /** @var \Illuminate\Contracts\Session\Session */
    protected $session;

    /** Creates a new flash composer.
     *
     * @param \Illuminate\Contracts\Session\Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /** Get the composed data.
     *
     * @param string $view
     * @param array $data
     *
     * @return array
     */
    protected function data(string $view, array $data): array
    {
        return [
            'flash' => $this->session->pull(Flash::SESSION_KEY, []),
        ];
    }
}
