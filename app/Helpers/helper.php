<?php

     function avarage_review($detailsId){
         return \App\Models\Client\OrderDetail::where('product_id',$detailsId)->whereNotNull('review')->count();
    }

     function avarage_rating_star($detailsId){
        $rating_count = \App\Models\Client\OrderDetail::where('product_id',$detailsId)->whereNotNull('review')->count();
        $rating_sum = \App\Models\Client\OrderDetail::where('product_id',$detailsId)->whereNotNull('review')->sum('star');
        if($rating_sum==0){
          return 0;
        }else{
            return round($rating_sum/$rating_count);
        }

    }
 ?>