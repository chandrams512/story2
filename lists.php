<?php
$theme_url = $urls= base_url().getThemeName();
?>

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>jwplayer/jwplayer.js"></script> -->
<script type="text/javascript">
function blank() {
    $("#cocktail_suggest").find('input,textarea,select').val('');
    //CKEDITOR.instances['beer_desc'].setData('');
}

function set_orderby(limit, alpha, option, keyword, offset) {
    $("#cocktail-search-frm").submit();
}

function limitsubmit() {
    $('#cocktail-search-frm').submit();
}

function gosearch(limit, alpha, option, offset) {
    ///var keyword = $("#keyword").val();
    ///window.location.href = "<?php echo site_url(); ?>cocktail/lists/"+limit+"/"+alpha+"/"+option+"/"+keyword+"/";
    //alert();
}
</script>

<!-- content -->

<div class="wrapper row4">
    <div class="container clearfix">
        <div id="slider-fixed-banner" class="carousel slide">
            <div class="carousel-inner">
                <div class="active item">
                    <?php /* $getimagename = getimagenamebanner();?>
                    <?php 
									if($getimagename->cocktail_directory==1 && $getimagename->cocktail_directory!="" && is_file(base_path().'upload/bar_pages_banner_orig/'.$getimagename->cocktail_directory)){ ?>
                    <img src="<?php echo base_url().'upload/bar_pages_banner/'.$getimagename->cocktail_directory; ?>" />
                    <?php
									} else {?>
                    <?php } */ 
            	$v=0;
          $getad_banner = '';
            	$getad_banner = getadvertisementBannerSearchBar('find_cocktail'); 
				if($getad_banner){
					
						 ?>
                    <?php 
	     				$count = getadvertisementBannerByIDCount(@$getad_banner['banner_pages_id'],$getad_banner['type']);
						if($getad_banner['type']=='click')
						{
							$cnt = $getad_banner['number_click'];
						}
						else
						{
							$cnt = $getad_banner['number_visit'];
						}
						
						$getad_new = getadvertisementByID_banner(@$getad_banner['banner_pages_id'],'visit');
		
						if(($getad_new==0 || $getad_new<5) && $count<$cnt && $getad_banner['type']=='visit' && $getad_banner['type']!='')
						{
							$array = array('ip'=>$_SERVER['REMOTE_ADDR'],'datetime'=>date('Y-m-d H:i:s'),'banner_pages_id'=>$getad_banner['banner_pages_id'],'click_type'=>'visit');
							$this->db->insert('count_clcik_advertisement_banner',$array);
							
							$array1 = array('total_visit'=>$getad_banner['total_visit']+1);
							$this->db->where('banner_pages_id',$getad_banner['banner_pages_id']);
							$this->db->update('banner_pages_master',$array1);
						}
						
						$v= 1;
	     				if($getad_banner && $count<$cnt){ ?>
                    <?php if(($getad_banner['banner_pages_image']!='' && file_exists(base_path().'upload/banner_pages_thumb/'.$getad_banner['banner_pages_image']))){ ?>
                    <a target="_blank"
                        <?php if($getad_banner['type']=='click'){?>onclick="add_click_banner('<?php echo $getad_banner['banner_pages_id'];?>');"
                        <?php } ?> href="<?php echo $getad_banner['url']; ?>"><img
                            src="<?php echo base_url().'upload/banner_pages_thumb/'.$getad_banner['banner_pages_image']; ?>"
                            class="img-responsive" /></a>
                    <?php } ?>
                    <?php } else { ?>
                    <img src="<?php echo base_url().'upload/banner_pages_thumb/'.$getad_banner['banner_pages_image']; ?>"
                        class="img-responsive" />

                    <?php } }  else { 
		     			  	$v= 0;?>
                    <!-- <img src="<?php echo base_url(); ?>/default/images/smallbanner1.png" alt="American Dive Bars"/> -->
                    <?php } ?>


                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- <a class="left carousel-control" href="#slider-fixed-banner" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#slider-fixed-banner" data-slide="next">&rsaquo;</a> -->

        </div>
    </div>
</div>
<div>
    <div class="wrapper row5 beer-list" style="border:<?php echo $v==0 ? 'none':'';?>">
        <div class="container">
            <div id="suggest_message"></div>
            <form class="form-horizontal" id="cocktail-search-frm" method="post" role="form"
                action="<?php echo base_url("cocktail/lists"); ?>">
                <div class="pull-left" style="width: 100%;">
                    <div class="result_search beer-search" id="bannerTop">
                        <div class="form-group pull-left" id="filterDiv">
                            <div class="form-group  pull-left" style="margin-right: 10px; width: 100%">
                                <label for="inputEmail3" class="control-label">Sort By :</label>
                                <select class="select_box" name="order_by" id="order_by"
                                    onchange="set_orderby('<?php echo $limit;?>','<?php echo $alpha;?>','<?php echo $options;?>','<?php echo $keyword;?>','<?php echo $offset; ?>')">
                                    <option value="">-- Select By--</option>
                                    <option value="cocktail_name#ASC" <?php if($order_by == "cocktail_name#ASC"){ ?>
                                        selected="selected" <?php } ?>>Name A-Z</option>
                                    <option value="cocktail_name#DESC" <?php if($order_by == "cocktail_name#DESC"){ ?>
                                        selected="selected" <?php } ?>>Name Z-A</option>
                                </select>
                            </div>
                            <div class="form-group pull-left" style="margin-right: 10px; width: 100%">
                                <label for="inputEmail3" class="control-label">Results Per Page :</label>
                                <select class="select_box" name="limit" id="limit" onchange="limitsubmit();">
                                    <option value="20" <?php if($limit==20){ ?> selected="selected" <?php } ?>>20
                                    </option>
                                    <option value="30" <?php if($limit==30){ ?> selected="selected" <?php } ?>>30
                                    </option>
                                    <option value="40" <?php if($limit==40){ ?> selected="selected" <?php } ?>>40
                                    </option>
                                    <option value="50" <?php if($limit==50){ ?> selected="selected" <?php } ?>>50
                                    </option>
                                    <option value="100" <?php if($limit == "100"){?> selected="selected" <?php } ?>>100
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="pull-left">
                            <?php if($keyword!='' && $keyword!='0'){?>
                            <div class="result_search_text pull-left">Search Result for
                                <?php echo htmlentities($keyword); ?></div>
                            <?php } ?>
                            <!-- <div class="result_search_text pull-left"><?php echo $total_rows;?> Results Found</div> -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right" id="sugestCocktail">
                            <a href="#suggestmodal" onclick="blank()" data-toggle="modal"
                                class="btn btn-lg review extra_cls" id="sugestCocktailBtn">Suggest New Drink</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <?php 
							$classnew = '-full';
							$getad = '';
							$getadnew = '';
							$w = 0;
						$getad = getadvertisement('cocktaillist','top'); 
						$getadnew = getadvertisement('cocktaillist','bottom'); 
					if($getad || $getadnew){
					$classnew = '';	
							$w = 1;
					}
						 ?>
                <div class="left_block<?php echo $classnew;?>">

                    <div class="alphabate_block">
                        <ul class="alphabate_list <?php echo $w==0 ? 'wid-72':'';?>">

                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("a")); ?>"
                                    <?php if($alpha == "a"){ ?> class="active" <?php }?>>a</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("b")); ?>"
                                    <?php if($alpha == "b"){ ?> class="active" <?php }?>>b</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("c")); ?>"
                                    <?php if($alpha == "c"){ ?> class="active" <?php }?>>c</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("d")); ?>"
                                    <?php if($alpha == "d"){ ?> class="active" <?php }?>>d</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("e")); ?>"
                                    <?php if($alpha == "e"){ ?> class="active" <?php }?>>e</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("f")); ?>"
                                    <?php if($alpha == "f"){ ?> class="active" <?php }?>>f</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("g")); ?>"
                                    <?php if($alpha == "g"){ ?> class="active" <?php }?>>g</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("h")); ?>"
                                    <?php if($alpha == "h"){ ?> class="active" <?php }?>>h</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("i")); ?>"
                                    <?php if($alpha == "i"){ ?> class="active" <?php }?>>i</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("j")); ?>"
                                    <?php if($alpha == "j"){ ?> class="active" <?php }?>>j</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("k")); ?>"
                                    <?php if($alpha == "k"){ ?> class="active" <?php }?>>k</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("l")); ?>"
                                    <?php if($alpha == "l"){ ?> class="active" <?php }?>>l</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("m")); ?>"
                                    <?php if($alpha == "m"){ ?> class="active" <?php }?>>m</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("n")); ?>"
                                    <?php if($alpha == "n"){ ?> class="active" <?php }?>>n</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("o")); ?>"
                                    <?php if($alpha == "o"){ ?> class="active" <?php }?>>o</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("p")); ?>"
                                    <?php if($alpha == "p"){ ?> class="active" <?php }?>>p</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("q")); ?>"
                                    <?php if($alpha == "q"){ ?> class="active" <?php }?>>q</a></li>
                            <li><a href="<?php echo site_url("beer/lists/".$limit."/".base64_encode("r")); ?>"
                                    <?php if($alpha == "r"){ ?> class="active" <?php }?>>r</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("s")); ?>"
                                    <?php if($alpha == "s"){ ?> class="active" <?php }?>>s</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("t")); ?>"
                                    <?php if($alpha == "t"){ ?> class="active" <?php }?>>t</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("u")); ?>"
                                    <?php if($alpha == "u"){ ?> class="active" <?php }?>>u</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("v")); ?>"
                                    <?php if($alpha == "v"){ ?> class="active" <?php }?>>v</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("w")); ?>"
                                    <?php if($alpha == "w"){ ?> class="active" <?php }?>>w</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("x")); ?>"
                                    <?php if($alpha == "x"){ ?> class="active" <?php }?>>x</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("y")); ?>"
                                    <?php if($alpha == "y"){ ?> class="active" <?php }?>>y</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("z")); ?>"
                                    <?php if($alpha == "z"){ ?> class="active" <?php }?>>z</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("'-#")); ?>"
                                    <?php if($alpha == "'-#"){ ?> class="active" <?php }?>>['-#]</a></li>
                            <li><a href="<?php echo site_url("cocktail/lists/".$limit."/".base64_encode("0-9")); ?>"
                                    <?php if($alpha == "0-9"){ ?> class="active" <?php }?>>[0-9]</a></li>
                            <div class="clearfix"></div>
                        </ul>



                    </div>
                    <div>
                        <div class="advance-block padt10" style="width: 100%">
                            <div class="form-group" >
                                <div class="col-sm-4 padding-right-0 input_box pull-left" id="searchCocktail">
                                    <input type="text" class="form-control form-pad  " id="keyword" name="keyword"
                                        placeholder="Search by Cocktail" value="<?php echo htmlentities($keyword); ?>">
                                    <input type="hidden" name="alpha" id="alpha" value="<?php echo $alpha; ?>" />
                                </div>
                                <div class="col-sm-1 input_box pull-left">
                                    <button
                                        onclick="gosearch('<?php echo $limit;?>','<?php echo $alpha;?>','<?php echo $options;?>','<?php echo $keyword;?>','<?php echo $offset; ?>');"
                                        class="btn  btn-lg btn-primary small-search"><i
                                            class="strip search"></i></button>
                                </div>

                                <div class="col-sm-4 padding-right-0 input_box pull-left" id="searchCocktail">
                                    <input type="text" class="form-control form-pad  " id="keyword1" name="keyword1"
                                        placeholder="Search by Base Spirit"
                                        value="<?php echo htmlentities($keyword1); ?>">
                                </div>
                                <div class="col-sm-1 input_box pull-left">
                                    <button
                                        onclick="gosearch('<?php echo $limit;?>','<?php echo $alpha;?>','<?php echo $options;?>','<?php echo $keyword;?>','<?php echo $offset; ?>');"
                                        class="btn  btn-lg btn-primary small-search"><i
                                            class="strip search"></i></button>
                                </div>
                                <div class="pagination mart20">
                                    <ul class="pagination">
                                        <?php echo $page_link; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
            </form>
            <div class="result_box liquor-box clearfix">
                <ul class="result_sub_box">
                    <?php if($result){
				  			foreach($result as $rs)
	  					{?>
                    <li class="active">
                        <div class="media">
                            <a class="pull-left widheig120"
                                href="<?php echo site_url("cocktail/detail/".$rs->cocktail_slug);?>">
                                <?php 
									if($rs->cocktail_image!="" && is_file(base_path().'upload/cocktail_list/'.$rs->cocktail_image)){ ?>
                                <img src="<?php echo base_url().'upload/cocktail_list/'.$rs->cocktail_image; ?>"
                                    height="119px" width="120px" />
                                <?php
									}
									else{?>
                                <img height="119" width="120"
                                    src="<?php echo base_url().'upload/cocktail_thumb/no_image.png'; ?>" />
                                <?php } ?>
                            </a>
                            <!-- <div class="pull-left btn btn-lg btn-primary text-center full-detail-btn"><a
                                    href="<?php echo site_url("cocktail/detail/".$rs->cocktail_slug);?>">Full
                                    Details</a></div> -->
                            <div class="media-body">
                                <div class="reult_sub_title">
                                    <h4 class="media-heading"><a class="pull-left listing-title"
                                            href="<?php echo site_url("cocktail/detail/".$rs->cocktail_slug);?>"><?php echo $rs->cocktail_name; ?></a>
                                    </h4>
                                </div>
                                <!-- <div class="rating_box"><a href="#"><img src="images/rating.png"/></a></div> -->
                                <div class="clearfix"></div>
                                <!-- <div class="result_desc">
                                    <?php // if(strip_tags(strlen($rs->how_to_make_it)>350)){ echo substr(strip_tags($rs->how_to_make_it),0,350).'...' ; } else { echo strip_tags($rs->how_to_make_it); } ?>
                                    <?php //echo substr(strip_tags($rs->ingredients),0,350).'...'; ?></div> -->

                                <div class="padt8">
                                    <ul class="cocktaildirectory">
                                        <li>
                                            <div class="pull-left yellow_text marr_10">Base Spirit : </div>
                                            <div class="pull-left white_text"><?php echo $rs->base_spirit; ?></div>
                                            <div class="clearfix"></div>
                                        </li>
                                        <li>
                                            <div class="pull-left yellow_text marr_10">Strength : </div>
                                            <div class="pull-left white_text"><?php echo $rs->strength; ?></div>
                                            <div class="clearfix"></div>
                                        </li>
                                        <li>
                                            <div class="pull-left yellow_text marr_10">Difficulty : </div>
                                            <div class="pull-left white_text"><?php echo $rs->difficulty; ?></div>
                                            <div class="clearfix"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <div class="clearfix"></div>
                    <?php
							}
						}else {
						?>
                    <li class="active">
                        No Records Found.
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div>

                <div class="pagination mart20">
                    <ul class="pagination">
                        <?php echo $page_link; ?>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php 
							$getad = '';
							$getadnew = '';
						$getad = getadvertisement('cocktaillist','top'); 
						$getadnew = getadvertisement('cocktaillist','bottom'); 
					if($getad || $getadnew){
						 ?>
        <div class="right_block coctail-new">
            <div>

                <div class="advertise-div">
                    <?php 
						$getad = getadvertisement('cocktaillist','top'); 
						if($getad){
	     				$count = getadvertisementByIDCount(@$getad['advertisement_id'],$getad['type']);
							
						if($getad['type']=='click')
						{
							$cnt = $getad['number_click'];
						}
						else
						{
							$cnt = $getad['number_visit'];
						}
						$getad_new = getadvertisementByID(@$getad['advertisement_id'],'visit');
		
						if(($getad_new==0 || $getad_new<5) && $count<$cnt  && $getad['type']=='visit')
						{
							$array = array('ip'=>$_SERVER['REMOTE_ADDR'],'datetime'=>date('Y-m-d H:i:s'),'advertisement_id'=>$getad['advertisement_id'],'click_type'=>'visit');
							$this->db->insert('count_clcik_advertisement',$array);
							
							$array1 = array('total_visit'=>$getad['total_visit']+1);
							$this->db->where('advertisement_id',$getad['advertisement_id']);
							$this->db->update('advertisement_master',$array1);
						}
						
	     				if($getad && $count<$cnt){ ?>
                    <?php if(($getad['advertisement_image']!='' && file_exists(base_path().'upload/advertisement_thumb/'.$getad['advertisement_image']))){ ?>
                    <a target="_blank"
                        <?php if($getad['type']=='click'){?>onclick="add_click('<?php echo $getad['advertisement_id'];?>');"
                        <?php } ?> href="<?php echo $getad['url']; ?>"><img
                            src="<?php echo base_url().'upload/advertisement_thumb/'.$getad['advertisement_image']; ?>"
                            class="img-responsive" /></a>
                    <?php } ?>
                    <?php } else {?>
                    <img src="<?php echo base_url(); ?>/upload/adv.png" class="img-responsive" />

                    <?php } } else { ?>

                    <!-- <img src="<?php echo base_url(); ?>/upload/adv.png" class="img-responsive"/> -->

                    <?php } ?>

                </div>

                <div class="advertise-div-right mar_top20">
                    <?php 
						$getadnew = getadvertisement('cocktaillist','bottom'); 
						if($getadnew){
	     				$countsec = getadvertisementByIDCount(@$getadnew['advertisement_id'],$getadnew['type']);
							
						if($getadnew['type']=='click')
						{
							$cntsec = $getadnew['number_click'];
						}
						else
						{
							$cntsec = $getadnew['number_visit'];
						}
						$getad_newsec = getadvertisementByID(@$getadnew['advertisement_id'],'visit');
		
		   
						if(($getad_newsec==0 || $getad_newsec<5)  && $countsec<$cntsec  && $getadnew['type']=='visit')
						{
							$array = array('ip'=>$_SERVER['REMOTE_ADDR'],'datetime'=>date('Y-m-d H:i:s'),'advertisement_id'=>$getadnew['advertisement_id'],'click_type'=>'visit');
							$this->db->insert('count_clcik_advertisement',$array);
							
							$array1 = array('total_visit'=>$getadnew['total_visit']+1);
							$this->db->where('advertisement_id',$getadnew['advertisement_id']);
							$this->db->update('advertisement_master',$array1);
						}
						
	     				if($getadnew && $countsec<$cntsec){ ?>
                    <?php if(($getadnew['advertisement_image']!='' && file_exists(base_path().'upload/advertisement_thumb/'.$getadnew['advertisement_image']))){ ?>
                    <a target="_blank"
                        <?php if($getadnew['type']=='click'){?>onclick="add_click('<?php echo $getadnew['advertisement_id'];?>');"
                        <?php } ?> href="<?php echo $getadnew['url']; ?>"><img
                            src="<?php echo base_url().'upload/advertisement_thumb/'.$getadnew['advertisement_image']; ?>"
                            class="img-responsive" /></a>
                    <?php } ?>
                    <?php } else {?>
                    <img src="<?php echo base_url(); ?>/upload/adv.png" class="img-responsive" />

                    <?php } } else { ?>
                    <!-- <img src="<?php echo base_url(); ?>/upload/adv.png" class="img-responsive"/> -->
                    <?php } ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php } ?>
</div>
</div>
<div class="modal fade login_pop2" id="suggestmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <?php $this->load->view(getThemeName().'/bar/cocktail_suggest');?>
</div>
<style>
.pagination {
	margin: 5px 0;
	display: inline-flex;
    justify-content: center;
    width: 100%;
}

#searchCocktail {
	width: 35%;
	margin-bottom: 5px;
}

#filterDiv {
    width: 70%;
    display: block
}

#bannerTop {
    display: flex;
    justify-content: space-around;
    align-items: center;
}

#order_by {
    width: 50% !important;
    margin-bottom: 5px;
}

#limit {
    width: 20% !important
}

.extra_cls {
    margin-bottom: 0;
}

#sugestCocktail {
    width: 30%
}

#sugestCocktailBtn {
    width: 100%;
    white-space: normal;
    font-size: 14pt;
    float: right;
}

.result_desc {
    text-align: left
}

@media screen and (max-width: 980px) {
    #sugestCocktailBtn {
        font-size: 12pt !important;
    }
}
/* 
@media screen and (max-width: 720px) {
	#searchCocktail{
		width: 55%
	}
} */
	
@media screen and (max-width: 670px) {
    #searchCocktail {
        width: 60%;
    }

    /* .pagination {
        margin: 12px 0 5px 15px;
        float: left;
    } */
}

@media screen and (max-width: 519px) {
    #bannerTop {
        display: flow-root;
    }

    #sugestCocktail {
        width: 40%;
        margin-left: 5px
    }

    #filterDiv {
        width: 100%;
    }

    #order_by {
        width: 70% !important;
    }

    #limit {
        width: 30% !important
    }
}

@media screen and (max-width: 409px) {
    #sugestCocktail {
        width: 60%
    }
}
</style>
<script>
function add_click(id) {
    //  window.location.href = '<?php //echo site_url('cocktail/lists');?>'; 
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('home/add_clcik')?>",
        data: {
            id: id
        },
        dataType: 'JSON',
        success: function(response) {


        }
    });
}

function add_click_banner(id) {

    // window.location.href = '<?php echo current_url();?>'; 
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('home/add_clcik_banner')?>",
        data: {
            id: id
        },
        dataType: 'JSON',
        success: function(response) {


        }
    });
}
</script>
<!-- ########################################################################################### -->