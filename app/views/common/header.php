<? $this->load->view('common/html') ?>
<header>
<nav class="navbar navbar-normal navbar-fixed-top">
  <div class="first-menu">
      <div class="container">
        <div class="navbar-header">
          <div class="logo-min">
            <figure>
              <a href="<?= base_url() ?>">
                <?= img(layout('imgs/header/logo-min.png')); ?>
              </a>
            </figure>
          </div>
          <div class="hidden-md hidden-lg" id="menu-mobile">
          </div>
          <form method="post" action="<?= base_url() ?>productos" class="navbar-form hidden-sm hidden-xs">
            <label for="hsearch">Buscar</label>
            <input type="text" id="hsearch" name="text" value="<?= isset($search->filter->text) ? $search->filter->text : "" ?>" class="form-control" />
          </form>
        </div>
        <div id="collapse" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav navbar-right">
            <li class="hidden-sm hidden-xs"><a href="<?= base_url() ?>mi-cuenta">Mi cuenta</a></li>
            <li class="hidden-sm hidden-xs"><a href="<?= base_url() ?>informacion/ayuda">Ayuda</a></li>
            <li><? $this->load->view('cart/session'); ?></li>
          </ul>
        </div>
      </div>
  </div>
</nav>
  <div class="big-logo text-center">
    <figure>
      <a href="<?= base_url() ?>">
        <?= img(layout('imgs/header/logo.png')); ?>
      </a>
    </figure>
  </div>

<div id="login-menu" class="collapse">
    <div class="container">
      <li class="col-sm-3 col-sm-offset-1"><a href="#">Iniciar Sesion</li></a>
      <li class="col-sm-3"><a href="#">Regístrate</li></a>
      <li class="col-sm-3"><a href="#">Ayuda</li></a>
    </div>
</div>

<div id="cart-menu" class="collapse">
<button class="btn-close" type="button"><span aria-hidden="true">×</span></button>
    <div class="page-cart-body" style="padding:20px;">
      <table class="table table-list-cart">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Ref.</th>
                        <th>Tallas</th>
                        <th>Color</th>
                        <th>Unidades</th>
                        <th>Precio</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                    <tr>
                        <th><img src="<?= layout('imgs/tmp/0521041705_2_3_1.jpg'); ?>" /></th>
                        <th>Look 5</th>
                        <th>255669 ARG <i class="success block">Disponible</i></th>
                        <th class="options">
             <select class="selectpicker" data-style="select-default" name="sizes" data-width="80px">
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
              </select>
              <div class="visible-xs"><input class="form-control" type="number" min="1" value="2"></div>
            </th>
                        <th class="options">
              <select class="selectpicker" data-style="select-default" name="colors" data-showContent="true" data-width="80px">
                <option value="red" data-content="<span class='btn circle' style='background-color: red;''></span>"></option>
                <option value="blue" data-content="<span class='btn circle' style='background-color: blue;''></span>"></option>
                <option value="green" data-content="<span class='btn circle' style='background-color: green;''></span>"></option>
              </select>
                        </th>
                        <th class="options hidden-xs"><input class="form-control" type="number" min="1" value="2"></th>
                        <th>60 €</th>
                        <th><i class="fa fa-times"></i></th>
                    </tr>


                    <tr>
                        <th><img src="<?= layout('imgs/tmp/0521041705_2_3_1.jpg'); ?>" /></th>
                        <th>Look 5</th>
                        <th>255669 ARG <i class="success block">Disponible</i></th>
                        <th class="options">
             <select class="selectpicker" data-style="select-default" name="sizes" data-width="80px">
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
              </select>
              <div class="visible-xs"><input class="form-control" type="number" min="1" value="2"></div>
            </th>
                        <th class="options">
              <select class="selectpicker" data-style="select-default" name="colors" data-showContent="true" data-width="80px">
                <option value="red" data-content="<span class='btn circle' style='background-color: red;''></span>"></option>
                <option value="blue" data-content="<span class='btn circle' style='background-color: blue;''></span>"></option>
                <option value="green" data-content="<span class='btn circle' style='background-color: green;''></span>"></option>
              </select>
                        </th>
                        <th class="options hidden-xs"><input class="form-control" type="number" min="1" value="2"></th>
                        <th>60 €</th>
                        <th><i class="fa fa-times"></i></th>
                    </tr>
                </tbody>
            </table> 

        <div class="row">
          
        <div class="col-xs-6"><span class="hstyle2 pull-right">Total_</span></div>
           
            <div class="total col-xs-6">
              <span class="pull-right">180 €</span>
            </div> 
              <div class="clearboth"></div>
        </div>

    </div>

    <div class="page-header style2">
      <div class="container">
          
        <div class="row">
          <h3><a data-toggle="collapse" href="#collapseCuppon" aria-expanded="false" aria-controls="collapseCuppon">¿Tienes algun código de descuento?</a></h3>
  
          <div class="collapse text-center" id="collapseCuppon" role="tabpanel">
            <div>
              <p>
              Aplica tu codigo y lorem ipsum dolara amet.<br>
              Aplica tu codigo y lorem ipsum dolara amet:
              </p>

              <div class="form-group">
                <label for="cupon"></label>
                <input type="text" name="cupon" id="cupon" class="form-control btn-block">
              </div>
              <button class="btn btn-block btn-gold">
                Aplicar cambio
              </button>
            </div>

          </div>
          

        </div>
      </div>
    </div>
    <div class="text-center">
      
        <button class="btn btn-primary" style="margin-bottom:20px">Realizar el pedido</button>
    </div>
</div>

<div id="search-menu" class="collapse">
  <form class="navbar-form mobile-search">
    <input type="text" id="hsearch" class="form-control" placeholder="Buscar">
  </form>   
</div>

<div class="second-menu" id="second-menu" aria-multiselectable="true" role="tablist">

  <form class="navbar-form mobile-search visible-xs">
    <input type="text" id="hsearch" class="form-control" placeholder="Buscar">
  </form>   

  <ul class="nav nav-navbar">
    <?/* <li><a data-toggle="collapse" data-parent="#second-menu" href="#collapseBrands" aria-expanded="false" aria-controls="collapseBrands">Por marca</a></li>*/?>
    <li class="<?= ( $sectionMenu == 'productos' ) ? "active" : "" ?>"><a data-toggle="collapse" data-parent="#second-menu" href="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">Por producto</a></li>
    <li class="<?= ( $sectionMenu == 'look' ) ? "active" : "" ?>"><a href="<?= base_url() ?>looks">Looks</a></li>
    <li class="<?= ( $sectionMenu == 'colecciones' ) ? "active" : "" ?>"><a href="<?= base_url() ?>colecciones">Colecciones</a></li>
    <li class="<?= ( $sectionMenu == 'rebajas' ) ? "active" : "" ?>"><a href="<?= base_url() ?>rebajas">Rebajas</a></li>
  </ul>

<div class="third-menu">
  <div class="collapse" id="collapseBrands" role="tabpanel">
    <div class="container">
      <ul class="brands-list list-unstyled row text-center">
        <li>
          <a href="">
            <div class="figure">
              <?= img(layout('imgs/header/logo.png')); ?>
            </div>
            <h2>Nombe Marca</h2>
          </a>
        </li>
      </ul>
  </div>
</div>
<div class="collapse" id="collapseProducts" role="tabpanel">
<div class="container">
<?= $navWidget ?>
</div>
</div>
</div>
</div>
</header>
