<?php

namespace test;

class Controller
{
	protected $tpl;
	protected $req;
    protected $action; //текущий action

	public function __construct()
	{
		$this->tpl = S('Template');
		$this->req = S('Request');
		$this->action = $this->req->getDir(0);

		if( ($this->action == 'brand1') || ($this->action == 'brand2') )
		{
			$this->tpl->setGlob('baseurl', "/$this->action");
		}
		else
		{
			$this->tpl->setGlob('baseurl', '');
            $this->action = 'index';
		}

		session_start();

		$this->_performChecks();
	}

	protected function _subscribe()
	{
		$_SESSION[$this->action]['subs'] = 1;
	}

	protected function _unsubscribe()
	{
		$_SESSION[$this->action]['subs'] = 0;
	}

	private function _isSubscribed()
	{
		return isset($_SESSION[$this->action]['subs']) ? $_SESSION[$this->action]['subs'] : 0;
	}

	private function _performChecks()
	{
		$action = S('Request')->getDir(0);
		if ($action && in_array($action, S('Request')->getDirs())){
          $action = S('Request')->getDir(1);
        }

		if( !$this->_isSubscribed() && ($action != 'subscribe') )
		{
			Response::redirect('/subscribe');
		}
	}
}
