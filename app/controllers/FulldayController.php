<?php

class FulldayController extends \BaseController {


	private $fullday_quota = 180;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$fullday = Peserta::where('fullday','=','1');
		$num_of_fullday = $fullday->count();		
		$fullday = $fullday->orderBy('rank','asc')->paginate(10);
		return View::make('fullday')
			->with('num_of_fullday',$num_of_fullday)
			->with('fullday',$fullday);
	}


	public function get_data()
	{
		$fullday = Peserta::where('fullday','=','1')->get();
		return array('result' => $fullday->load('prestasi','nilai.mata_pelajaran','hasil_wawancara','hasil_test'));
	}

	public function update_data()
	{
		$sorted_data = Input::get('data');
		var_dump($sorted_data);
		foreach ($sorted_data as $key => $pes) {
			$peserta = Peserta::find($pes['id']);
			$peserta->saw_result = $pes['saw_result'];
			echo $peserta['id']." : ";
			echo $peserta['saw_result']."    ";
			$peserta->rank = $key+1;

			if($peserta->rank <= $this->fullday_quota) {
				$peserta->status = 4;
				if($peserta->rank <= 30){
					$peserta->kelas = "Excelent";
				}else if($peserta->rank <= 60){
					$peserta->kelas = "Brilliant";
				}else if($peserta->rank <= 90){
					$peserta->kelas = "Smart";
				}else if($peserta->rank <= 120){
					$peserta->kelas = "Mumtaz";
				}else if($peserta->rank <= 150){
					$peserta->kelas = "Mahir";
				}else if($peserta->rank <= 180){
					$peserta->kelas = "Ulwan";
				}					
			}			
			else{
				$peserta->status = 3;
				$peserta->kelas = " ";
			}
				

			$peserta->save();
		}

		return "success";
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
