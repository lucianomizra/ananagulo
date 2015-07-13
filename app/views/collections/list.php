<div class="row products-listx">
    <? for($k = 0; $k<count($productsSearch); $k+= 10) : $i = $k; ?>
    <? if(isset($productsSearch[$i])): ?><div class="col-sm-6 height3 product-list-itemx"><? $this->load->view('collections/list-det', array('szx' => true, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
    <? if(isset($productsSearch[++$i])): ?>
    <div class="col-sm-6 no-padding product-list-itemx">
      <? if(isset($productsSearch[$i])): ?><div class="col-sm-6 height1"><? $this->load->view('collections/list-det', array('szx' => false, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
      <? if(isset($productsSearch[++$i])): ?><div class="col-sm-6 height1"><? $this->load->view('collections/list-det', array('szx' => false, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
      <? if(isset($productsSearch[++$i])): ?><div class="col-sm-6 height1"><? $this->load->view('collections/list-det', array('szx' => false, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
      <? if(isset($productsSearch[++$i])): ?><div class="col-sm-6 height1"><? $this->load->view('collections/list-det', array('szx' => false, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
    </div> 
    <? endif ?>
    <? if(isset($productsSearch[++$i])): ?>
    <div class="col-sm-6 no-padding product-list-itemx">
      <? if(isset($productsSearch[$i])): ?><div class="col-sm-6 height1"><? $this->load->view('collections/list-det', array('szx' => false, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
      <? if(isset($productsSearch[++$i])): ?><div class="col-sm-6 height1"><? $this->load->view('collections/list-det', array('szx' => false, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
      <? if(isset($productsSearch[++$i])): ?><div class="col-sm-6 height1"><? $this->load->view('collections/list-det', array('szx' => false, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
      <? if(isset($productsSearch[++$i])): ?><div class="col-sm-6 height1"><? $this->load->view('collections/list-det', array('szx' => false, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
    </div>  
    <? endif ?>
    <? if(isset($productsSearch[++$i])): ?><div class="col-sm-6 height3 product-list-itemx"><? $this->load->view('collections/list-det', array('szx' => true, 'item' => $productsSearch[$i] )) ?></div><? endif ?>
  <? endfor ?>
</div>