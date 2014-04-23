<?php
namespace Asgard\Search\Controllers;

class SearchController extends \Asgard\Core\Controller {
	/**
	@Route('search')
	*/
	public function indexAction($request) {
		$this->searchWidget();
		$this->results = array();

		if($this->form->isSent()) {
			$term = $this->form->term->getValue();
			
			foreach(Search::searchEntities('Actualite', $term) as $actualite)
				$this->results[] = array('title'=>$actualite, 'description'=>$actualite->content, 'link'=>$actualite->url());
		}
	}

	public function searchWidget() {
		$this->form = new \Asgard\Form\Form('search', array('action'=>\Asgard\Core\App::get('url')->url_for(array('Asgard\Search\Controllers\SearchController', 'index'))));
		$this->form->term = new \Asgard\Form\Fields\TextField;
	}
}