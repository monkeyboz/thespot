<?php 
    class impressions extends db{
        public function impressions($page){
            if(!isset($page[0])){
                $page[0] = null;
            }
            if(!isset($page[1])){
                $page[1] = 0;
            }
            $this->captureImpression($page[0], $page[1]);
        }
        
        public function captureImpression($type='user', $id=0){
            $updates = date('Y-m-d 23:59:59');
            $impression = $this->query('SELECT * FROM impressions WHERE type="'.$type.'" AND id="'.$id.'" AND ip="'.$_SERVER['REMOTE_ADDR'].'" AND date<"'.$updates.'" ORDER BY date DESC LIMIT 1');
            if(sizeof($impression) > 0){
                ++$impression[0]['count'];
                $this->edit('impressions', $impression[0], array('id'=>$impression[0]['id']));
            } else {
                $impression = array('type'=>$type, 'id'=>$id, 'ip'=>$_SERVER['REMOTE_ADDR']);
                $this->save('impressions', $impression);
            }
        }
    }
?>