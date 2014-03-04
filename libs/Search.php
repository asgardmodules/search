<?php
namespace Coxis\Search\Controllers;

class Search {
	public static function searchEntities($entityName, $term) {
		$orm = $entityName::orm();
		$conditions = array();
		foreach($entityName::propertyNames() as $prop)
			$conditions[] = "$prop LIKE '%$term%'";
		return $orm->where(array('or'=>$conditions))->get();
	}
}