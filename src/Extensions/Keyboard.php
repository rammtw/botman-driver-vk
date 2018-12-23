<?php

namespace BotMan\Drivers\VK\Extensions;

use Illuminate\Support\Collection;

/**
 * Class Keyboard.
 */
class Keyboard
{
    protected $oneTimeKeyboard = false;

    /**
     * @var array
     */
    protected $rows = [];

    /**
     * @param bool $active
     * @return $this
     */
    public function oneTimeKeyboard($active = true)
    {
        $this->oneTimeKeyboard = $active;

        return $this;
    }

    /**
     * Add a new row to the Keyboard.
     * @param KeyboardButton[] $buttons
     * @return Keyboard
     */
    public function addRow(KeyboardButton ...$buttons)
    {
        $this->rows[] = $buttons;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'keyboard' => json_encode(Collection::make([
                'one_time' => $this->oneTimeKeyboard,
                'buttons' => $this->rows
            ]), JSON_UNESCAPED_UNICODE),
        ];
    }
}
