<?php





/**
 * Abstract class for smarty's template services.
 *
 */
abstract class TemplateService {

	protected $serviceName;

	public function serviceName(){
		return $this->serviceName;
	}

	public function test(){
		return "service working";
	}

}
