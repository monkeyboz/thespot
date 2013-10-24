<?php
  $this->pagination['total'] = $this->pagination['total'][0]['COUNT(*)'];
  $this->pagination['totalPages'] = ceil($this->pagination['total']/$total);
  $this->pagination['query'] = '';
  foreach($this->pageQ as $k => $w){
    $this->pagination['query'] .= '&'.$k.'='.$w;
  }
?>