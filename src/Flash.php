<?php

namespace Industrious\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    /** @var string */
    const SESSION_KEY = '_flash_messages';

    /** @var \Illuminate\Contracts\Session\Session */
    protected $session;

    /** @var array */
    protected $messages = [];

    /** Constructs a new flash service.
     *
     * @param \Illuminate\Contracts\Session\Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /** Flash the messages to the session. */
    public function flash(): void
    {
        if (empty($this->messages)) {
            return;
        }

        $mapped = [];
        foreach ($this->messages as $class => $messages) {
            $mapped = array_merge(
                $mapped,
                array_map(function ($message) use ($class) {
                    return compact('class', 'message');
                }, $messages)
            );
        }

        $this->session->put(self::SESSION_KEY, $mapped);
    }

    /** Add a message.
     *
     * @param string $class
     * @param string $message
     */
    public function add(string $class, string $message): void
    {
        if (! isset($this->messages[$class])) {
            $this->messages[$class] = [];
        }

        $this->messages[$class][] = $message;
    }
}
