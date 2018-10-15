<div class="col-md-10 col-sm-8 col-lg-offset-0 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">
    <div class="profile-page">

      <div class="user-info">
        <div class="container">
          <div class="row">

            <div class="col-xs-12 col-md-10 offset-md-1">
              <div class="user-prof">
                <img [src]="profile.image" class="user-img" />
                <h4><?php echo $user_details["name"];?></h4>
                <h5> Followers <?php echo $followers;?> &nbsp; &nbsp; &nbsp; &nbsp; Following  <?php echo $following;?> </h5>
              </div>
              <h5><?php echo $dizcoveries;?> Total Dizcoveries</h5>
              <app-follow-button
                [hidden]="isUser"
                [profile]="profile"
                (toggle)="onToggleFollowing($event)">
              </app-follow-button>
              <?php if ($user_details['email'] == $this->session->email) {
                ?>
               <a [routerLink]="['/settings']"
                  [hidden]="!isUser"
                  class="btn btn-sm btn-outline-secondary action-btn">
                  <i class="ion-gear-a"></i> Edit Profile
                </a>
             <?php  } else
              {
                 ?>
               <a href="<?php echo base_url('follow/user/').$user_details['id'];?>" 
                  class="btn btn-sm btn-outline-secondary action-btn">
                  <i class="ion-gear-a"></i> <?php if ($follower < 1) {echo 'Follow'; } else {echo 'Unfollow' ;} ?>  <?php echo $user_details['name'];?>
                </a> <?php 

              } ?>
            </div>

          </div>
        </div>
      </div>
    </div>

      <div class="col-xs-12 col-md-10 offset-md-1">
        <div class="articles-toggle">
          <ul class="nav nav-pills outline-active">
            <li class="nav-item">
              <a class="nav-link"
                 routerLinkActive="active"
                 >
                 My Popular Dizcoveries
              </a>
            </li>
          
          </ul>
        </div>
        <article-preview article="article" ng-repeat="article in $ctrl.list" class="ng-scope ng-isolate-scope">
            <?php foreach ($diz_list as $l): ?>
            <div class="article-preview">
              <article-meta article="$ctrl.article" class="ng-isolate-scope"><div class="article-meta">
              <a ui-sref="app.profile.main({ username:$ctrl.article.author.username })" href="#/@noone">
                <img ng-src="https://static.productionready.io/images/smiley-cyrus.jpg" src="<?php echo $l['dizcovery_img'];?> ">
              </a>

              <div class="info">
                <a class="author ng-binding" ui-sref="app.profile.main({ username:$ctrl.article.author.username })" ng-bind="$ctrl.article.author.username" href="#/@noone"><?php echo $user_details['name'];?></a>
                <span class="date ng-binding" ng-bind="$ctrl.article.createdAt | date: 'longDate' "><?php echo date('M d Y', strtotime($l['created_at']));?></span>
              </div>

              <ng-transclude>
                <favorite-btn article="$ctrl.article" class="pull-xs-right ng-scope ng-isolate-scope"><button class="btn btn-sm btn-outline-primary" ng-class="{ 'disabled': $ctrl.isSubmitting,
                          'btn-outline-primary': !$ctrl.article.favorited,
                          'btn-primary': $ctrl.article.favorited }" ng-click="$ctrl.submit()">

              <i class="ion-heart"></i> <ng-transclude><span class="ng-binding ng-scope">
                  0
                </span></ng-transclude>

            </button>
            </favorite-btn>
              </ng-transclude>
            </div>
          </article-meta>
        </div>
        <a ui-sref="app.article({ slug: $ctrl.article.slug })" class="preview-link" href="<?php echo base_url('dizcoveries').'/item/'.$l['id'];?>">
    <h5 ng-bind="$ctrl.article.title" class="ng-binding"><?php echo $l['dizcovery_title'] ?></h5>
    <p ng-bind="$ctrl.article.description" class="ng-binding"><?php echo $l['dizcovery_detail'] ?>.</p>
    <span>Read more...</span>
    <ul class="tag-list">
      <!-- ngRepeat: tag in $ctrl.article.tagList -->
    </ul>
  </a>
                  <?php endforeach ;?>

      </article-preview>
        </router-outlet>
      </div>
</div>