$(function(){
            $('.tomakewidth').width($('.span3').width());
            $('#login').submit(function(){
                $('.loading').show();
                $.ajax({
                type: "POST",
                url: 'login.php?step=login',
                data: $(this).serialize(),
                success: function(data){
                 if(data.st=="error")
                    {
                        $('.msg').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                        $('.msg').fadeIn(2000);
                    }else
                        {
                            $('.msg').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                            $('.msg').fadeIn(2000,function(){
                                location.reload(true);
                            });
                        }
                 $('.loading').hide();
                },
                dataType: 'json'
              });

                return false;
            });
            
            $('textarea[id="text"]').jqte();
           $('#usettings').submit(function(){
            $('input[name="textb"]').val($('textarea[id="text"]').val());
              $('.loder').show();
                $.ajax({
                type: "POST",
                url: 'ajax.php?step=setting',
                data: $(this).serialize(),
                success: function(data){
                 if(data.st=="error")
                    {
                        $('.msgs').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                        $('.msgs').fadeIn(2000);
                    }else
                        {
                            $('.msgs').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                            $('.msgs').fadeIn(2000,function(){
                               // location.reload(true);
                              // alert(data.msg);
                            });
                        }
                 $('.loder').hide();
                },
                dataType: 'json'
              });
              
               return false;
           });
           
           
           
           $('#logout').click(function(){
           
             $.ajax({
                type: "POST",
                url: 'ajax.php?step=logout',
                success: function(data){
                 if(data.st =="done")
                    {
                        alert(data.msg);
                        location.reload(true);
                        
                    }
                
                },
                dataType: 'json'
              });
              
            return false;
           });
           
           
           
           
           
           $('.type').change(function(){
              var wt =  $(this).val();
              wt = parseInt(wt);
              
              if(wt==0)
                {
                $('.linkToshare').hide();    
                }else if (wt==1){
                $('.linkToshare').show();    
                    
                }
                
           });
           
           
           
           $('#adminUpdate').submit(function(){
            $('.loder').show();
              $.ajax({
                type: "POST",
                url: 'ajax.php?step=admin',
                data: $(this).serialize(),
                success: function(data){
                 if(data.st=="error")
                    {
                        $('.msgs').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                        $('.msgs').fadeIn(2000);
                    }else
                        {
                            $('.msgs').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                            $('.msgs').fadeIn(2000,function(){
                               // location.reload(true);
                              // alert(data.msg);
                            });
                        }
                 $('.loder').hide();
                },
                dataType: 'json'
              });
            
            return false;
        });
           
           $('.uremove').click(function(){
                var uid = $(this).attr('uid');           
                $.ajax({
                      type: "POST",
                      url: 'ajax.php?step=userRemove',
                      data: {'userid':uid},
                      success: function(data){
                          $('tr[uid="t'+ uid +'"]').slideUp(1000,function(){
                               $(this).remove();
                           });
                }});
             return false;
           });
           
          $('.btnsharenow').click(function(){
              var text = $('.postText').val();
              var type =  $('.type').val();
              type = parseInt(type);
              var datatosend = {'text':text,'type':type};
              if(type==1)
                {
                var linktosend = $('.linkToshare').val();
                datatosend = {'text':text,'type':type,'link':linktosend};
                
                }
                
        //     alert(text);
              $('.loder').show();
              $.ajax({
                type: "POST",
                url: 'ajax.php?step=addPost',
                data: datatosend,
                success: function(data){
                 if(data.st=="error")
                    {
                        $('.msgs').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                        $('.msgs').fadeIn(2000);
                    }else
                        {
                            $('.msgs').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                            $('.msgs').fadeIn(2000);
                            postNow(data.postId);
                             $('.postText').val("");
                        }
                 $('.loder').hide();
                },
                dataType: 'json'
              });
            
              
              
              return false;
              
          }); 
          
          
           
           
           $('.btnaddpost').click(function(){
              var text2 = $('.postText').val();
               var type2 =  $('.type').val();
               type2 = parseInt(type2);
              
              var datatosend2 = {'text':text2,'type':type2};
              if(type2==1)
                {
                var linktosend2 = $('.linkToshare').val();
                datatosend2 = {'text':text2,'type':type2,'link':linktosend2};
                
                }
         //     alert(text);
              $('.loder').show();
              $.ajax({
                type: "POST",
                url: 'ajax.php?step=addPost',
                data: datatosend2,
                success: function(data){
                 if(data.st=="error")
                    {
                        $('.msgs').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                        $('.msgs').fadeIn(2000);
                    }else
                        {
                            $('.msgs').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                            $('.msgs').fadeIn(2000);
                            $('.postText').val("");
                           
                        }
                 $('.oldpost').load('ajax.php?step=oldPOST',function(){
                  $('.loder').hide();    
                 });
                },
                dataType: 'json'
              });
              
                   return false;
           });
           
           
           $('.see').live('click',function(){
               var id = $(this).attr('id');
                 $('.modal-body').load('ajax.php?step=postget&id='+id,function(){
                      $('#myModal').modal('show');
                });  
                return false;
           });
           
           $('.send').live('click',function(){
               var id2 = $(this).attr('id');
               postNow(id2);
                return false;
           });
           $('.delete').live('click',function(){
               var id3 = $(this).attr('id');
                 $.ajax({
                      type: "POST",
                      url: 'ajax.php?step=postRemove',
                      data: {'id':id3},
                      success: function(data){
                          $('tr[id="t'+ id3 +'"]').slideUp(1000,function(){
                               $(this).remove();
                           });
                }});
                return false;
           });
           
           
           
           
        });
        
        
        
        function postNow(postid)
        {     $('.loder').show();
             $('.msgs').append('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> جاري النشر الان</div>');
                $.ajax({
                type: "POST",
                url: 'fb.php',
                data: {'id':postid},
                success: function(data){
                 if(data.st=="error")
                    {
                        $('.msgs').append('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                        $('.msgs').fadeIn(2000);
                    }else
                        {
                            $('.msgs').append('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> ' + data.msg + '.</div>');
                            $('.msgs').fadeIn(2000);
                     
                        }
                 $('.oldpost').load('ajax.php?step=oldPOST',function(){
                  $('.loder').hide();    
                 });
                 
                 
                },
                dataType: 'json'
              });
           
        }
        
        