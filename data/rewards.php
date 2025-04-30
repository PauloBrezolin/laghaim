<?php

    class stReward
    {

        public $id;
        public $race;
        public $minlevel;
        public $maxlevel;
        public $plus;
        public $amount;
        public $flag;
        public $dura;

        public function __construct($id, $race, $minlevel, $maxlevel, $plus = 0, $amount = 1, $flag = 0, $dura = 0)
        {
            $this->id = $id;
            $this->race = $race;
            $this->minlevel = $minlevel;
            $this->maxlevel = $maxlevel;
            $this->plus = $plus;
            $this->amount = $amount;
            $this->flag = $flag;
            $this->dura = $dura;
        }

    }


    function s($name)
    {
    	$name = strtolower($name);
    	$races = array('bulkan', 'kailipton', 'aidia', 'human', 'hibrider', 'perom');
    	return array_search($name, $races);
    }


    $weapons = [];
    $other = [];
    $shields = [];
    
    /** LEVEL 500+ **/
    // Aidia
    $weapons[] = new stReward(10004, s('Aidia'), 500, 999, 10, 1, 50335743, 100);
    $other[] = new stReward(3636,  s('Aidia'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3637,  s('Aidia'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3638,  s('Aidia'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3639,  s('Aidia'), 500, 999, 8, 1, 255, 100);
    $shields[] = new stReward(3651, s('Aidia'), 500, 999, 5, 1, 255, 100);
    $other[] = new stReward(10380, s('Aidia'), 500, 999, 0, 2);

    // Bulkan
    $weapons[] = new stReward(10000, s('Bulkan'), 500, 999, 10, 1, 50335743, 100);
    $weapons[] = new stReward(10001, s('Bulkan'), 500, 999, 10, 1, 50335743, 100);
    $other[] = new stReward(3624,  s('Bulkan'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3625,  s('Bulkan'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3626,  s('Bulkan'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3627,  s('Bulkan'), 500, 999, 8, 1, 255, 100);
    $shields[] = new stReward(3648, s('Bulkan'), 500, 999, 5, 1, 255, 100);
    $other[] = new stReward(10377, s('Bulkan'), 500, 999, 0, 2);

    // Kailipton
    $weapons[] = new stReward(10002, s('Kailipton'), 500, 999, 10, 1, 50335743, 100);
    $other[] = new stReward(3628,  s('Kailipton'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3629,  s('Kailipton'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3630,  s('Kailipton'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3631,  s('Kailipton'), 500, 999, 8, 1, 255, 100);
    $shields[] = new stReward(3649, s('Kailipton'), 500, 999, 5, 1, 255, 100);
    $other[] = new stReward(10378, s('Kailipton'), 500, 999, 0, 2);

    // Human
    $weapons[] = new stReward(10003, s('Human'), 500, 999, 10, 1, 50335743, 100);
    $other[] = new stReward(3632,  s('Human'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3633,  s('Human'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3634,  s('Human'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3635,  s('Human'), 500, 999, 8, 1, 255, 100);
    $shields[] = new stReward(3650, s('Human'), 500, 999, 5, 1, 255, 100);
    $other[] = new stReward(10381, s('Human'), 500, 999, 0, 2);

    //Hibrider
    $weapons[] = new stReward(10005, s('Hibrider'), 500, 999, 10, 1, 50335743, 100);
    $weapons[] = new stReward(10006, s('Hibrider'), 500, 999, 10, 1, 50335743, 100);
    $other[] = new stReward(3640,  s('Hibrider'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3641,  s('Hibrider'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3642,  s('Hibrider'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3643,  s('Hibrider'), 500, 999, 8, 1, 255, 100);
    $shields[] = new stReward(3652, s('Hibrider'), 500, 999, 5, 1, 255, 100);    
    $shields[] = new stReward(3653, s('Hibrider'), 500, 999, 5, 1, 255, 100);    
    $other[] = new stReward(10379, s('Hibrider'), 500, 999, 0, 2);

    //Perom
    $weapons[] = new stReward(10007, s('Perom'), 500, 999, 10, 1, 50335743, 100);
    $other[] = new stReward(3644,  s('Perom'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3645,  s('Perom'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3646,  s('Perom'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(3647,  s('Perom'), 500, 999, 8, 1, 255, 100);
    $other[] = new stReward(10008,  s('Perom'), 500, 999, 0, 2);
    $other[] = new stReward(10376, s('Perom'), 500, 999, 0, 2);


    /** LEVEL 480 - 499 **/
    // Aidia
    $weapons[] = new stReward(10004, s('Aidia'), 480, 499, 8, 1, 50335743, 100);
    $other[] = new stReward(3636,  s('Aidia'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3637,  s('Aidia'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3638,  s('Aidia'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3639,  s('Aidia'), 480, 499, 6, 1, 255, 100);
    $shields[] = new stReward(3651, s('Aidia'), 480, 499, 3, 1, 255, 100);

    // Bulkan
    $weapons[] = new stReward(10000, s('Bulkan'), 480, 499, 8, 1, 50335743, 100);
    $weapons[] = new stReward(10001, s('Bulkan'), 480, 499, 8, 1, 50335743, 100);
    $other[] = new stReward(3624,  s('Bulkan'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3625,  s('Bulkan'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3626,  s('Bulkan'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3627,  s('Bulkan'), 480, 499, 6, 1, 255, 100);
    $shields[] = new stReward(3648, s('Bulkan'), 480, 499, 3, 1, 255, 100);

    // Kailipton
    $weapons[] = new stReward(10002, s('Kailipton'), 480, 499, 8, 1, 50335743, 100);
    $other[] = new stReward(3628,  s('Kailipton'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3629,  s('Kailipton'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3630,  s('Kailipton'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3631,  s('Kailipton'), 480, 499, 6, 1, 255, 100);
    $shields[] = new stReward(3649, s('Kailipton'), 480, 499, 3, 1, 255, 100);

    // Human
    $weapons[] = new stReward(10003, s('Human'), 480, 499, 8, 1, 50335743, 100);
    $other[] = new stReward(3632,  s('Human'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3633,  s('Human'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3634,  s('Human'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3635,  s('Human'), 480, 499, 6, 1, 255, 100);
    $shields[] = new stReward(3650, s('Human'), 480, 499, 3, 1, 255, 100);

    //Hibrider
    $weapons[] = new stReward(10005, s('Hibrider'), 480, 499, 8, 1, 50335743, 100);
    $weapons[] = new stReward(10006, s('Hibrider'), 480, 499, 8, 1, 50335743, 100);
    $other[] = new stReward(3640,  s('Hibrider'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3641,  s('Hibrider'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3642,  s('Hibrider'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3643,  s('Hibrider'), 480, 499, 6, 1, 255, 100);
    $shields[] = new stReward(3652, s('Hibrider'), 480, 499, 3, 1, 255, 100);    
    $shields[] = new stReward(3653, s('Hibrider'), 480, 499, 3, 1, 255, 100);    

    //Perom
    $weapons[] = new stReward(10007, s('Perom'), 480, 499, 8, 1, 50335743, 100);
    $other[] = new stReward(3644,  s('Perom'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3645,  s('Perom'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3646,  s('Perom'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(3647,  s('Perom'), 480, 499, 6, 1, 255, 100);
    $other[] = new stReward(10008,  s('Perom'), 480, 499, 0, 2);
    $other[] = new stReward(1964,  s('Perom'), 480, 499, 0, 2);

    /** LEVEL 450 - 479 */
    // Aidia
    $weapons[] = new stReward(10004, s('Aidia'), 450, 479, 7, 1, 50335743, 100);
    $other[] = new stReward(3636,  s('Aidia'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3637,  s('Aidia'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3638,  s('Aidia'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3639,  s('Aidia'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3067,  s('Aidia'), 450, 479);


    // Bulkan
    $weapons[] = new stReward(10000, s('Bulkan'), 450, 479, 7, 1, 50335743, 100);
    $weapons[] = new stReward(10001, s('Bulkan'), 450, 479, 7, 1, 50335743, 100);
    $other[] = new stReward(3624,  s('Bulkan'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3625,  s('Bulkan'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3626,  s('Bulkan'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3627,  s('Bulkan'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3064,  s('Bulkan'), 450, 479);

    // Kailipton
    $weapons[] = new stReward(10002, s('Kailipton'), 450, 479, 7, 1, 50335743, 100);
    $other[] = new stReward(3628,  s('Kailipton'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3629,  s('Kailipton'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3630,  s('Kailipton'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3631,  s('Kailipton'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3065,  s('Kailipton'), 450, 479);

    // Human
    $weapons[] = new stReward(10003, s('Human'), 450, 479, 7, 1, 50335743, 100);
    $other[] = new stReward(3632,  s('Human'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3633,  s('Human'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3634,  s('Human'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3635,  s('Human'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3068,  s('Human'), 450, 479);

    //Hibrider
    $weapons[] = new stReward(10005, s('Hibrider'), 450, 479, 7, 1, 50335743, 100);
    $weapons[] = new stReward(10006, s('Hibrider'), 450, 479, 7, 1, 50335743, 100);
    $other[] = new stReward(3640,  s('Hibrider'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3641,  s('Hibrider'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3642,  s('Hibrider'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3643,  s('Hibrider'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3066,  s('Hibrider'), 450, 479);

    //Perom
    $weapons[] = new stReward(10007, s('Perom'), 450, 479, 7, 1, 50335743, 100);
    $other[] = new stReward(3644,  s('Perom'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3645,  s('Perom'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3646,  s('Perom'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3647,  s('Perom'), 450, 479, 3, 1, 255, 100);
    $other[] = new stReward(3232,  s('Perom'), 450, 479);


    /** LEVEL 420 - 449 */
    // Aidia
    $weapons[] = new stReward(2177, s('Aidia'), 420, 449, 10, 1, 50335743, 100);
    $other[] = new stReward(2309,  s('Aidia'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2310,  s('Aidia'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2311,  s('Aidia'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2312,  s('Aidia'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3248,  s('Aidia'), 420, 449);


    // Bulkan
    $weapons[] = new stReward(2173, s('Bulkan'), 420, 449, 10, 1, 50335743, 100);
    $weapons[] = new stReward(2174, s('Bulkan'), 420, 449, 10, 1, 50335743, 100);
    $other[] = new stReward(2305,  s('Bulkan'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2306,  s('Bulkan'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2307,  s('Bulkan'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2308,  s('Bulkan'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3245,  s('Bulkan'), 420, 449);

    // Kailipton
    $weapons[] = new stReward(2175, s('Kailipton'), 420, 449, 10, 1, 50335743, 100);
    $other[] = new stReward(2313,  s('Kailipton'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2314,  s('Kailipton'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2315,  s('Kailipton'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2316,  s('Kailipton'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3246,  s('Kailipton'), 420, 449);

    // Human
    $weapons[] = new stReward(2176, s('Human'), 420, 449, 10, 1, 50335743, 100);
    $other[] = new stReward(2300,  s('Human'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2301,  s('Human'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2302,  s('Human'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2303,  s('Human'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3249,  s('Human'), 420, 449);

    //Hibrider
    $weapons[] = new stReward(2178, s('Hibrider'), 420, 449, 10, 1, 50335743, 100);
    $weapons[] = new stReward(2179, s('Hibrider'), 420, 449, 10, 1, 50335743, 100);
    $other[] = new stReward(2295,  s('Hibrider'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2296,  s('Hibrider'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2297,  s('Hibrider'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(2298,  s('Hibrider'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3247,  s('Hibrider'), 420, 449);

    //Perom
    $weapons[] = new stReward(3323, s('Perom'), 420, 449, 10, 1, 50335743, 100);
    $other[] = new stReward(3227,  s('Perom'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3228,  s('Perom'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3229,  s('Perom'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3230,  s('Perom'), 420, 449, 6, 1, 255, 100);
    $other[] = new stReward(3244,  s('Perom'), 420, 449);


    /** LEVEL 400 - 419 */
    // Aidia
    $weapons[] = new stReward(2177, s('Aidia'), 400, 419, 6, 1, 50335743, 100);
    $other[] = new stReward(2309,  s('Aidia'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2310,  s('Aidia'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2311,  s('Aidia'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2312,  s('Aidia'), 400, 419, 3, 1, 255, 100);


    // Bulkan
    $weapons[] = new stReward(2173, s('Bulkan'), 400, 419, 6, 1, 50335743, 100);
    $weapons[] = new stReward(2174, s('Bulkan'), 400, 419, 6, 1, 50335743, 100);
    $other[] = new stReward(2305,  s('Bulkan'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2306,  s('Bulkan'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2307,  s('Bulkan'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2308,  s('Bulkan'), 400, 419, 3, 1, 255, 100);

    // Kailipton
    $weapons[] = new stReward(2175, s('Kailipton'), 400, 419, 6, 1, 50335743, 100);
    $other[] = new stReward(2313,  s('Kailipton'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2314,  s('Kailipton'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2315,  s('Kailipton'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2316,  s('Kailipton'), 400, 419, 3, 1, 255, 100);

    // Human
    $weapons[] = new stReward(2176, s('Human'), 400, 419, 6, 1, 50335743, 100);
    $other[] = new stReward(2300,  s('Human'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2301,  s('Human'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2302,  s('Human'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2303,  s('Human'), 400, 419, 3, 1, 255, 100);

    //Hibrider
    $weapons[] = new stReward(2178, s('Hibrider'), 400, 419, 6, 1, 50335743, 100);
    $weapons[] = new stReward(2179, s('Hibrider'), 400, 419, 6, 1, 50335743, 100);
    $other[] = new stReward(2295,  s('Hibrider'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2296,  s('Hibrider'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2297,  s('Hibrider'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(2298,  s('Hibrider'), 400, 419, 3, 1, 255, 100);

    //Perom
    $weapons[] = new stReward(3323, s('Perom'), 400, 419, 6, 1, 50335743, 100);
    $other[] = new stReward(3227,  s('Perom'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(3228,  s('Perom'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(3229,  s('Perom'), 400, 419, 3, 1, 255, 100);
    $other[] = new stReward(3230,  s('Perom'), 400, 419, 3, 1, 255, 100);


    /** LEVEL 380 - 399 */
    // Aidia
    $weapons[] = new stReward(2177, s('Aidia'), 380, 399, 0, 1, 50335743, 100);
    $other[] = new stReward(2309,  s('Aidia'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2310,  s('Aidia'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2311,  s('Aidia'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2312,  s('Aidia'), 380, 399, 0, 1, 255, 100);


    // Bulkan
    $weapons[] = new stReward(2173, s('Bulkan'), 380, 399, 0, 1, 50335743, 100);
    $weapons[] = new stReward(2174, s('Bulkan'), 380, 399, 0, 1, 50335743, 100);
    $other[] = new stReward(2305,  s('Bulkan'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2306,  s('Bulkan'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2307,  s('Bulkan'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2308,  s('Bulkan'), 380, 399, 0, 1, 255, 100);

    // Kailipton
    $weapons[] = new stReward(2175, s('Kailipton'), 380, 399, 0, 1, 50335743, 100);
    $other[] = new stReward(2313,  s('Kailipton'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2314,  s('Kailipton'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2315,  s('Kailipton'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2316,  s('Kailipton'), 380, 399, 0, 1, 255, 100);

    // Human
    $weapons[] = new stReward(2176, s('Human'), 380, 399, 0, 1, 50335743, 100);
    $other[] = new stReward(2300,  s('Human'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2301,  s('Human'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2302,  s('Human'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2303,  s('Human'), 380, 399, 0, 1, 255, 100);

    //Hibrider
    $weapons[] = new stReward(2178, s('Hibrider'), 380, 399, 0, 1, 50335743, 100);
    $weapons[] = new stReward(2179, s('Hibrider'), 380, 399, 0, 1, 50335743, 100);
    $other[] = new stReward(2295,  s('Hibrider'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2296,  s('Hibrider'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2297,  s('Hibrider'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(2298,  s('Hibrider'), 380, 399, 0, 1, 255, 100);

    //Perom
    $weapons[] = new stReward(3323, s('Perom'), 380, 399, 0, 1, 50335743, 100);
    $other[] = new stReward(3227,  s('Perom'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(3228,  s('Perom'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(3229,  s('Perom'), 380, 399, 0, 1, 255, 100);
    $other[] = new stReward(3230,  s('Perom'), 380, 399, 0, 1, 255, 100);

    $other[] = new stReward(2158, -1, 0, 999);

    $other[] = new stReward(10038, -1, 480, 999);
    $other[] = new stReward(1967, -1, 400, 419, 0, 2);
    $other[] = new stReward(10380, s('Aidia'), 450, 499);
    $other[] = new stReward(10377, s('Bulkan'), 450, 499);
    $other[] = new stReward(10378, s('Kailipton'), 450, 499);
    $other[] = new stReward(10381, s('Human'), 450, 499);
    $other[] = new stReward(10379, s('Hibrider'), 450, 499);
    $other[] = new stReward(10376, s('Perom'), 450, 499);    