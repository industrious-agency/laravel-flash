<?php

namespace Industrious\Flash\Traits;

trait FlashesMessages
{
    /** Get the flash service and optionally flash a message.
     *
     * @param string|null $type
     * @param string|null $message
     *
     * @return \Industrious\Flash\Traits\Flash
     */
    protected function flash(string $type = null, string $message = null): Flash
    {
        $flash = resolve(Flash::class);

        if ($type !== null && $message === null) {
            [$message, $type] = [$type, 'info'];
        }

        if ($message !== null) {
            $flash->add($type, $message);
        }

        return $flash;
    }
}
