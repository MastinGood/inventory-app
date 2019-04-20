<?php

       function branch($id)
      {
             return DB::table('branches')->select('branchname')->where('id', $id)->first();
      }

