<?php

class RegulerController extends \BaseController {


	private $reguler_quota = 320;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$reguler = Peserta::where('fullday','=','0');
		$num_of_reguler = $reguler->count();		
		$reguler = $reguler->orderBy('rank','asc')->paginate(10);
		return View::make('reguler')
			->with('num_of_reguler',$num_of_reguler)
			->with('reguler',$reguler);
	}
	
	public function get_data()
	{
		$reguler = Peserta::where('fullday','=','0')->get();
		return array('result' => $reguler->load('prestasi','nilai.mata_pelajaran','hasil_wawancara','hasil_test'));
	}

	public function update_data()
	{
		$sorted_data = Input::get('data');
		foreach ($sorted_data as $key => $pes) {
			$peserta = Peserta::find($pes['id']);
			$peserta->saw_result = $pes['saw_result'];
			$peserta->rank = $key+1;

			if($peserta->rank <= $this->reguler_quota){
				$peserta->status = 2;
				
				if($peserta->rank % 8 == 1)
					$peserta->kelas = "A";
				else if($peserta->rank % 8 == 2)
					$peserta->kelas = "B";
				else if($peserta->rank % 8 == 3)
					$peserta->kelas = "C";
				else if($peserta->rank % 8 == 4)
					$peserta->kelas = "D";
				else if($peserta->rank % 8 == 5)
					$peserta->kelas = "E";
				else if($peserta->rank % 8 == 6)
					$peserta->kelas = "F";
				else if($peserta->rank % 8 == 7)
					$peserta->kelas = "G";
				else if($peserta->rank % 8 == 0)
					$peserta->kelas = "H";				
			}
			else {
				$peserta->status = 1;
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
