<?php
class Controller_Word extends Controller_Template
{

	public function action_index()
	{
		$data['words'] = Model_Word::find('all');
		$this->template->title = "Words";
		$this->template->content = View::forge('word/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('word');

		if ( ! $data['word'] = Model_Word::find($id))
		{
			Session::set_flash('error', 'Could not find word #'.$id);
			Response::redirect('word');
		}

		$this->template->title = "Word";
		$this->template->content = View::forge('word/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Word::validate('create');

			if ($val->run())
			{
				$word = Model_Word::forge(array(
					'content' => Input::post('content'),
				));

				if ($word and $word->save())
				{
					Session::set_flash('success', 'Added word #'.$word->id.'.');

					Response::redirect('word');
				}

				else
				{
					Session::set_flash('error', 'Could not save word.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Words";
		$this->template->content = View::forge('word/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('word');

		if ( ! $word = Model_Word::find($id))
		{
			Session::set_flash('error', 'Could not find word #'.$id);
			Response::redirect('word');
		}

		$val = Model_Word::validate('edit');

		if ($val->run())
		{
			$word->content = Input::post('content');

			if ($word->save())
			{
				Session::set_flash('success', 'Updated word #' . $id);

				Response::redirect('word');
			}

			else
			{
				Session::set_flash('error', 'Could not update word #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$word->content = $val->validated('content');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('word', $word, false);
		}

		$this->template->title = "Words";
		$this->template->content = View::forge('word/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('word');

		if ($word = Model_Word::find($id))
		{
			$word->delete();

			Session::set_flash('success', 'Deleted word #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete word #'.$id);
		}

		Response::redirect('word');

	}

}
