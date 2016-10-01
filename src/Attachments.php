<?php

namespace cjmaxik\VKCallbackAPI;

class Attachments implements \Iterator, \ArrayAccess
{
    /**
         * Iterator position.
         *
         * @var int
         */
        private $position = 0;

        /**
         * Array of attachments.
         *
         * @var array
         */
        public $attachments;

    public function __construct($attachments)
    {
        $this->position = 0;

        if (is_null($attachments)) {
            return;
        }

        foreach ($attachments as $k => $attachment) {
            switch ($attachment->type) {
                    case 'doc':
                        $this->attachments[$k] = (object) [
                            'type' => 'doc',
                            'ext'  => $attachment->doc->ext,
                            'url'  => $attachment->doc->url,
                        ];
                        break;

                    case 'photo':
                        $this->attachments[$k] = (object) [
                            'type' => 'photo',
                            'url'  => $this->take_biggest($attachment->photo),
                        ];
                        break;

                    case 'sticker':
                        $this->attachments[$k] = (object) [
                            'type' => 'sticker',
                            'url'  => $this->take_biggest($attachment->sticker),
                        ];

                    case 'video':
                        $this->attachments[$k] = (object) [
                            'type'        => 'video',
                            'title'       => $attachment->video->title,
                            'description' => $attachment->video->description,
                            'views'       => $attachment->video->views,
                            'comments'    => $attachment->video->comments,
                            'platform'    => $attachment->video->platform,
                            'preview_url' => $this->take_biggest($attachment->video),
                        ];
                        break;

                    case 'audio':
                        $this->attachments[$k] = (object) [
                            'type'  => 'audio',
                            'title' => $attachment->audio->artist.' - '.$attachment->audio->title,
                            'url'   => $attachment->audio->url,
                        ];
                        break;

                    case 'poll':
                        $this->attachments[$k] = "*Опрос \"{$attachment->poll->question}\".* Варианты ответов: ";
                        foreach ($attachment->poll->answers as $answer) {
                            $this->attachments[$k] .= "`{$answer->text}`";
                        }
                        break;

                    case 'link':
                        $this->attachments[$k] = "<{$attachment->link->url}|ссылка>";
                        if (isset($attachment->link->photo)) {
                            $this->attachments[$k] = '<'.$this->take_biggest($attachment->link->photo).'|превью>';
                        }
                        break;

                    default:
                        $this->attachments[$k] = '```'.var_export($attachment, true).'```';
                        break;
                }
        }
    }

    private function take_biggest($photo)
    {
        $biggest_key = '';
        $url = '';
        foreach ($photo as $key => $line) {
            if (substr_count($key, 'photo_')) {
                if (substr($key, 6) > $biggest_key) {
                    $biggest_key = substr($key, 6);
                    $url = $line;
                }
            }
        }

        return $url;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->attachments[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->attachments[$this->position]);
    }

    public function offsetSet($offset, $value)
    {
        return new \Exception('Can not change attachments');
    }

    public function offsetExists($offset)
    {
        return isset($this->attachments[$offset]);
    }

    public function offsetUnset($offset)
    {
        return new \Exception('Can not change attachments');
    }

    public function offsetGet($offset)
    {
        return isset($this->attachments[$offset]) ? $this->attachments[$offset] : null;
    }
}
