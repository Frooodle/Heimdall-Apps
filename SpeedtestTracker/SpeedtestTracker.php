<?php namespace App\SupportedApps\SpeedtestTracker;

class SpeedtestTracker extends \App\SupportedApps implements \App\EnhancedApps {

    public $config;


	public function test()
    {
        $test = parent::appTest($this->url('latest'));
        echo $test->status;
    }

    public function livestats()
    {

        $status = 'inactive';
        $details = json_decode(parent::execute($this->url('latest'))->getBody());
		
        $data['dlSpeed'] = round($details->data->download ?? 0, 0);
		$data['upSpeed'] = round($details->data->upload ?? 0, 0) ;
		$data['ping'] = round($details->data->ping ?? 999, 0);

        return parent::getLiveStats($status, $data);
        
    }

    public function url($endpoint)
    {
		$api_url = parent::normaliseurl($this->config->url).'api/speedtest/'.$endpoint;
        return $api_url;
    }
	
	
}
