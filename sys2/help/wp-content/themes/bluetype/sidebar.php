<!--- Sidebar Starts -->

<div id="sidebar" class="right-col">

    <div id="search">
        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
            <div>
                <input type="text" class="search_box" name="s" id="s" />
                <input type="image" src="<?php bloginfo('template_directory'); ?>/images/search.gif" class="submit" name="submit" />
            </div>
        </form>
    </div>

    <div id="sidebar_in">
                    <?php if (function_exists('woo_sidebar') && woo_sidebar(1)) : else : ?>

                    <?php endif; ?>
        <div id="authorList" class="block widget widget_links">
         <h2>创始人</h2>
         <ul class="blogroll">
             <li>黄诗栋</li>       
             <li>神秘老大</li>
             <li>吴琼珊</li>
             <li>周育鑫</li>
             <li>薛飞</li>
             <li>蒋钦</li>
             <li>鑫锦程同仁</li>
             <li>阮志聪</li>
             <li>郑伴</li>
             <li>王友义</li>
             <li>魏山珍</li>
             <li>黄振峰</li>
             <li>黄沛韬</li>
             <li>傅少锋</li>           
         </ul>
        </div>
    </div>
     
    <!--- Sidebar Ends -->