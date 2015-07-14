  <div class="page-footer">
    <div class="page-header phb">
      <h3 class="look-hhsm">Productos del look | <span><?= $look->name ?></span></h3>
    </div>
      <div class="row">
        <? for($k = 0; $k<count($products); $k+= 6) : $i = $k; ?>
        <? if(isset($products[$i])): ?><div class="col-sm-4 ">          
        <? $this->load->view('looks/list-det', array('szx' => 286, 'szy' => 245, 'item' => $products[$i] )) ?>
        </div>
        <? endif ?>
        <? if(isset($products[++$i])): ?>
        <div class="col-sm-8">
        <? $this->load->view('looks/list-det', array('szx' => 794, 'szy' => 245, 'item' => $products[$i] )) ?>
        </div>
        <? endif ?>

        <? if(isset($products[++$i])): ?>
        <div class="col-sm-4">
        <? $this->load->view('looks/list-det', array('szx' => 286, 'szy' => 510, 'item' => $products[$i] )) ?>
        </div>
        <? endif ?>

        <? if(isset($products[++$i])): ?>
        <div class="col-sm-4">
          <? if(isset($products[$i])): ?>
          <? $this->load->view('looks/list-det', array('szx' => 286, 'szy' => 245, 'item' => $products[$i] )) ?>
          <? endif ?>
          <? if(isset($products[++$i])): ?>
          <? $this->load->view('looks/list-det', array('szx' => 286, 'szy' => 245, 'item' => $products[$i] )) ?>
          <? endif ?>
        </div>
        <? endif ?>
        <? if(isset($products[++$i])): ?>
        <div class="col-sm-4">
        <? $this->load->view('looks/list-det', array('szx' => 286, 'szy' => 510, 'item' => $products[$i] )) ?>
        </div>
         <? endif ?>
        <? endfor ?>
        </div>
      </div>
    </div>
  </div>