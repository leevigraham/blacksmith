<?php

namespace Mpociot\Blacksmith\Models;

use Exception;

class Circle extends ForgeModel
{
    protected $id;

    /**
     * Invite a new forge user to a Circle
     *
     * @param $email
     * @return Circle
     * @throws Exception
     */
    public function inviteMember($email)
    {
        $result = $this->browser->postContent('https://forge.laravel.com/circles/'.$this->id.'/invite', [
            'email' => $email,
        ]);

        if ($this->browser->getSession()->getStatusCode() === 422) {
            throw new Exception('Error: '.print_r($result, true));
        }

        return new Circle($result, $this->browser);
    }

    /**
     * Set all members of the circle
     *
     * @param array $member_ids
     * @return Circle
     */
    public function setMembers($member_ids)
    {
        $result = $this->browser->putContent('https://forge.laravel.com/circles/'.$this->id.'/members', [
            'members' => $member_ids,
        ]);

        return new Circle($result, $this->browser);
    }

    /**
     * Set all servers of the circle
     *
     * @param array $server_ids
     * @return Circle
     */
    public function setServers($server_ids)
    {
        $result = $this->browser->putContent('https://forge.laravel.com/circles/'.$this->id.'/servers', [
            'servers' => $server_ids,
        ]);

        return new Circle($result, $this->browser);
    }
}
