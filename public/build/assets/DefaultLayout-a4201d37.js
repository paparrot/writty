import{y as L,z as H,r as y,l as z,T as R,o as l,c as i,b as t,e as F,v as U,u as r,n as u,t as g,g as p,d as C,q as A,s as I,A as _,K as S,O as x,B as N,F as $,C as T,i as D,p as O,a as V}from"./app-13a24cae.js";const b=L("posts",()=>{const c=new URL(window.location.href).searchParams,d=Number(c.get("page"))?Number(c.get("page")):1,s=H({data:[]}),n=y(!1),m=y(d),h=y(1),a=y(null),o=w=>{s.data=w},f=w=>{s.data=s.data.map(k=>(k.id===w&&(k.isLiked=!0,k.likesCount+=1),k))},v=w=>{s.data=s.data.map(k=>(k.id===w&&(k.isLiked=!1,k.likesCount-=1),k))},B=()=>{M(null),n.value=!0},M=w=>{a.value=w};return{posts:s,currentPage:m,lastPage:h,showPostModal:n,setPostToReply:M,postToReply:a,openPostModal:B,closePostModal:()=>{a.value&&M(null),n.value=!1},openReplyModal:w=>{M(w),n.value=!0},setPosts:o,setLiked:f,setUnliked:v,setCurrentPage:w=>{m.value=w},setLastPage:w=>{h.value=w}}});const q=(e,c)=>{const d=e.__vccOpts||e;for(const[s,n]of c)d[s]=n;return d},j=e=>(A("data-v-4098f065"),e=e(),I(),e),E=["onSubmit"],W={class:"mb-2"},K={class:"text-error"},G={class:"my-2 flex gap-3 items-center"},J=["for"],Q=j(()=>t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-paperclip",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5"})],-1)),X=["id"],Y={class:"text-error"},Z={key:0,class:"attachment-container relative w-32"},tt=["src"],et=_('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" data-v-4098f065><path stroke="none" d="M0 0h24v24H0z" fill="none" data-v-4098f065></path><path d="M4 7l16 0" data-v-4098f065></path><path d="M10 11l0 6" data-v-4098f065></path><path d="M14 11l0 6" data-v-4098f065></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" data-v-4098f065></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" data-v-4098f065></path></svg>',1),ot=[et],st=j(()=>t("div",{class:"form-control"},[t("button",{class:"btn btn-sm btn-primary w-full",type:"submit"},"Publish")],-1)),nt={__name:"PostForm",props:{replied:{type:String,default:null}},emits:["post-created"],setup(e,{emit:c}){const{replied:d}=e,s=z({get:()=>n.attachment?URL.createObjectURL(n.attachment):null,set:h=>h}),n=R({content:"",attachment:null});b();const m=async()=>{if(d){n.post(route("posts.reply",{post:d}),{preserveState:!1,onSuccess:()=>{n.reset(),c("post-created")}});return}n.post(route("posts.store"),{onSuccess:()=>{n.reset(),c("post-created")}})};return(h,a)=>(l(),i("form",{class:"py-3",onSubmit:C(m,["prevent"])},[t("div",W,[F(t("textarea",{name:"content",onInput:a[0]||(a[0]=o=>r(n).errors.content=null),"onUpdate:modelValue":a[1]||(a[1]=o=>r(n).content=o),placeholder:"What's happen?",class:u([{"textarea-error":r(n).content.length>255||r(n).errors.content},"textarea textarea-bordered resize-none textarea-sm w-full"])},null,34),[[U,r(n).content]]),t("p",K,g(r(n).errors.content),1),t("p",{class:u(["text-gray-500 text-xs",{"text-red-500":r(n).content.length>255}])},g(r(n).content.length)+" / 255",3),t("div",G,[t("label",{for:`attachment-${e.replied}`,class:u([r(n).errors.attachment,"my-2"])},[Q,t("input",{id:`attachment-${e.replied}`,class:"hidden",accept:"image/*",type:"file",onInput:a[2]||(a[2]=o=>r(n).attachment=o.target.files[0])},null,40,X)],10,J),t("p",Y,g(r(n).errors.attachment),1)]),s.value?(l(),i("div",Z,[t("img",{src:s.value,class:"attachment-image aspect-square object-cover rounded",alt:"Attachment"},null,8,tt),t("button",{onClick:a[3]||(a[3]=o=>r(n).attachment=null),type:"button",class:"attachment-remove-btn absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"},ot)])):p("",!0)]),st],40,E))}},rt=q(nt,[["__scopeId","data-v-4098f065"]]),P={loadMorePosts(){const e=b();if(e.currentPage>=e.lastPage)return;const c=e.currentPage+1,d=S(),s=new URL(window.location.href),n=s.searchParams;n.set("page",c),s.search=n.toString(),x.get(s.toString(),{},{preserveState:!0,preserveScroll:!0,only:["posts"],onSuccess:({props:m})=>{var o;const h=e.posts.data,a=((o=m.posts)==null?void 0:o.data)??m.replies.data;e.setPosts([...h,...a]),e.setCurrentPage(c),window.history.replaceState({},d.title,s.toString())}})},deletePost(e){x.delete(route("posts.delete",{post:e}))},like(e){const c=b();x.post(route("posts.like",{post:e}),{},{preserveState:!0,preserveScroll:!0,onSuccess:()=>{c.setLiked(e)}})},unlike(e){const c=b();x.delete(route("posts.unlike",{post:e}),{preserveState:!0,preserveScroll:!0,onSuccess:()=>{c.setUnliked(e)}})},listenDeletingPost(){const e=b();Echo.channel("feed").listen("PostDeleted",c=>{const d=e.posts.data;e.setPosts(d.filter(s=>s.id!==c.id))})},listenCreatingPost(){const e=b();Echo.channel("feed").listen("PostCreated",({post:c})=>{e.setPosts([c,...e.posts.data])})}},at={class:"border border-neutral-focus rounded p-3"},lt={class:"card-header mb-3 flex justify-between"},it={class:"author items-center flex gap-5"},ct={key:0,class:"avatar"},dt={class:"w-12 rounded-full"},ht=["href"],ut=["src"],pt={key:1,class:"avatar placeholder"},ft={class:"bg-neutral-focus text-neutral-content w-12 rounded-full"},vt={class:"text-2xl font-bold"},wt={class:"author-text"},mt={class:"font-bold"},gt=["href"],kt={class:"font-mono text-gray-500 text-sm"},bt=["href"],_t={class:"font-mono text-gray-500 text-sm"},yt=_('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7h16"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path><path d="M10 12l4 4m0 -4l-4 4"></path></svg>',1),xt=[yt],Mt={class:"break-words text-lg"},$t=["src"],Pt={key:1,class:"actions mt-2 flex items-center gap-2 justify-start"},Ct={class:"likes flex gap-1"},St={key:0,class:"font-bold text-lg"},zt=t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"},null,-1),jt=t("path",{d:"M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"},null,-1),Bt=[zt,jt],Lt=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-message-circle-2",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"})],-1),Ht=[Lt],Rt=["href"],Ft=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-message-circle-2",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"})],-1),Ut=[Ft],At={key:1},It=["href"],Nt={__name:"Post",props:{post:{type:Object,default:null},withoutActions:{type:Boolean,default:!1}},setup(e){const{withoutActions:c,post:d}=e,s=b(),n=S(),m=z(()=>{var h,a;return((a=(h=n.props.auth)==null?void 0:h.user)==null?void 0:a.nickname)===d.author.nickname&&!c});return(h,a)=>(l(),i("article",at,[t("div",lt,[t("div",it,[e.post.author.avatar?(l(),i("div",ct,[t("div",dt,[t("a",{href:h.route("profile.show",{user:e.post.author.nickname})},[t("img",{src:e.post.author.avatar,alt:"post.author.name"},null,8,ut)],8,ht)])])):(l(),i("div",pt,[t("div",ft,[t("span",vt,g(e.post.author.name),1)])])),t("div",wt,[t("h6",mt,[t("a",{href:h.route("profile.show",{user:e.post.author.nickname})},g(e.post.author.name),9,gt)]),t("p",kt,[t("a",{href:h.route("profile.show",{user:e.post.author.nickname})}," @"+g(e.post.author.nickname),9,bt)]),t("p",_t,g(e.post.created),1)])]),m.value?(l(),i("button",{key:0,onClick:a[0]||(a[0]=o=>r(P).deletePost(e.post.id))},xt)):p("",!0)]),t("p",Mt,g(e.post.content),1),e.post.attachment?(l(),i("img",{key:0,class:"aspect-square my-2 rounded",src:e.post.attachment,alt:"Attachment"},null,8,$t)):p("",!0),e.withoutActions?p("",!0):(l(),i("div",Pt,[t("div",Ct,[e.post.likesCount?(l(),i("p",St,g(e.post.likesCount),1)):p("",!0),h.$page.props.auth.user?(l(),i("button",{key:1,onClick:a[1]||(a[1]=o=>e.post.isLiked?r(P).unlike(e.post.id):r(P).like(e.post.id))},[(l(),i("svg",{class:u([{"fill-pink-300 stroke-pink-500":e.post.isLiked},"icon icon-tabler icon-tabler-heart"]),xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},Bt,2))])):p("",!0)]),h.$page.props.auth.user?(l(),i("button",{key:0,class:"hidden md:block",onClick:a[2]||(a[2]=C(o=>r(s).openReplyModal(e.post),["stop"]))},Ht)):p("",!0),t("a",{class:"md:hidden",href:h.route("posts.reply.create",{post:e.post.id})},Ut,8,Rt),e.post.repliesCount>0?(l(),i("div",At,[t("a",{class:"text-lg text-accent font-bold",href:h.route("posts.show",{post:e.post.id})},"Show "+g(e.post.repliesCount)+" replies...",9,It)])):p("",!0)]))]))}},Tt={class:"h-screen overflow-hidden max-w-6xl mx-auto flex gap-4 md:p-4"},Dt={class:"card card-bordered border-neutral w-3/12 hidden md:block p-4"},Ot={class:"space-y-3"},Vt=["href"],qt=["href"],Et=["href"],Wt=["href"],Kt=["href"],Gt=["href"],Jt={class:"w-full md:w-6/12 overflow-y-scroll rounded"},Qt={class:"sticky top-0 z-10 backdrop-blur-xl w-full mb-4"},Xt={class:"navbar flex justify-between shadow-md rounded-b"},Yt={class:"flex gap-3"},Zt=["href"],te=["href"],ee=_('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M9 12h12l-3 -3"></path><path d="M18 15l3 -3"></path></svg>',1),oe=[ee],se={class:"card card-bordered border-neutral w-3/12 hidden md:block p-4"},ne=t("h2",{class:"text-xl font-bold text-center mb-3"},"Latest authors",-1),re={class:"space-y-3"},ae=["href"],le={class:"w-full fixed bottom-0 md:hidden"},ie={class:"menu flex justify-between menu-horizontal bg-base-200 rounded-t-box"},ce=["href"],de=_('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M10 12h4v4h-4z"></path></svg>',1),he=[de],ue=["href"],pe=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-search",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"}),t("path",{d:"M21 21l-6 -6"})],-1),fe=[pe],ve={key:0},we=["href"],me=_('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 12h6"></path><path d="M12 9v6"></path><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path></svg>',1),ge=[me],ke={key:1},be=["href"],_e=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-heart-filled",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z","stroke-width":"0",fill:"currentColor"})],-1),ye=[_e],xe=["href"],Me=_('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path></svg>',1),$e=[Me],Pe={class:"flex items-center justify-between w-full mb-3"},Ce={key:0,class:"font-bold text-xl"},Se={key:1,class:"font-bold text-xl"},ze=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-x",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M18 6l-12 12"}),t("path",{d:"M6 6l12 12"})],-1),je=[ze],Ue={__name:"DefaultLayout",setup(e){var m,h,a;const c=S(),d=y((a=(h=(m=c.props)==null?void 0:m.auth)==null?void 0:h.user)==null?void 0:a.id);N(()=>{var o,f,v;d.value=(v=(f=(o=c.props)==null?void 0:o.auth)==null?void 0:f.user)==null?void 0:v.id});const s=b(),n=()=>{x.post(route("logout"))};return(o,f)=>(l(),i("div",Tt,[t("aside",Dt,[t("nav",null,[t("ul",Ot,[t("li",null,[t("a",{class:u([{"text-primary":o.route().current("home")},"btn btn-outline w-full"]),href:o.route("home")},"Home",10,Vt)]),d.value?p("",!0):(l(),i($,{key:0},[t("li",null,[t("a",{class:u([{"text-primary":o.route().current("login")},"btn btn-outline w-full"]),href:o.route("login")}," Login ",10,qt)]),t("li",null,[t("a",{class:u([{"text-primary":o.route().current("register")},"btn btn-outline w-full"]),href:o.route("register")}," Register ",10,Et)])],64)),t("li",null,[t("a",{class:u([{"text-primary":o.route().current("posts.search")},"btn btn-outline w-full"]),href:o.route("posts.search")}," Search ",10,Wt)]),d.value?(l(),i($,{key:1},[t("li",null,[t("a",{class:u([{"text-primary":o.route().current("profile.edit")},"btn btn-outline w-full"]),href:o.route("profile.edit")},"Profile",10,Kt)]),t("li",null,[t("a",{class:u([{"text-primary":o.route().current("posts.favourites")},"btn btn-outline w-full"]),href:o.route("posts.favourites")},"Favourites",10,Gt)]),t("li",null,[d.value?(l(),i("button",{key:0,onClick:f[0]||(f[0]=(...v)=>r(s).openPostModal&&r(s).openPostModal(...v)),class:"w-full btn btn-primary"},"New post ")):p("",!0)])],64)):p("",!0)])])]),t("main",Jt,[t("header",Qt,[t("nav",Xt,[t("div",Yt,[t("a",{class:u([{"text-primary":o.route().current("home")},"btn btn-ghost normal-case text-xl"]),href:o.route("home")}," Writty ",10,Zt),d.value?(l(),i("a",{key:0,class:u([{"text-primary":o.route().current("posts.following")},"btn btn-ghost normal-case text-xl"]),href:o.route("posts.following")}," Following ",10,te)):p("",!0)]),d.value?(l(),i("button",{key:0,onClick:n},oe)):p("",!0)])]),T(o.$slots,"default")]),t("aside",se,[ne,t("ul",re,[(l(!0),i($,null,D(r(c).props.latestAuthors,v=>(l(),i("li",null,[t("a",{class:"block font-bold w-full rounded px-2 py-1 text-center bg-base-200",href:o.route("profile.show",{user:v})},"@"+g(v),9,ae)]))),256))])]),t("footer",le,[t("ul",ie,[t("li",null,[t("a",{href:o.route("home"),class:u({"text-primary":o.route().current("home")})},he,10,ce)]),t("li",null,[t("a",{class:u({"text-primary":o.route().current("posts.search")}),href:o.route("posts.search")},fe,10,ue)]),d.value?(l(),i("li",ve,[t("a",{class:u({"text-primary":o.route().current("posts.create")}),href:o.route("posts.create")},ge,10,we)])):p("",!0),d.value?(l(),i("li",ke,[t("a",{class:u({"text-primary":o.route().current("posts.favourites")}),href:o.route("posts.favourites")},ye,10,be)])):p("",!0),t("li",null,[t("a",{class:u({"text-primary":o.route().current("profile.edit")}),href:d.value?o.route("profile.edit"):o.route("login")},$e,10,xe)])])]),r(s).showPostModal?(l(),i("div",{key:0,class:"absolute inset-0 bg-neutral-focus bg-opacity-95 z-20 grid place-items-center",onClick:f[3]||(f[3]=(...v)=>r(s).closePostModal&&r(s).closePostModal(...v))},[t("div",{onClick:f[2]||(f[2]=C(()=>{},["stop"])),class:"relative bg-white dark:bg-neutral card card-bordered p-4 w-full rounded md:w-1/2 md:max-w-5xl"},[t("div",Pe,[r(s).postToReply?(l(),i("h2",Ce,"Reply to ")):(l(),i("h2",Se,"Make new post")),t("button",{onClick:f[1]||(f[1]=(...v)=>r(s).closePostModal&&r(s).closePostModal(...v)),class:"btn btn-sm"},je)]),r(s).postToReply?(l(),O(Nt,{key:0,"without-actions":!0,post:r(s).postToReply},null,8,["post"])):p("",!0),V(rt,{onPostCreated:r(s).closePostModal},null,8,["onPostCreated"])])])):p("",!0)]))}};export{rt as P,Ue as _,q as a,Nt as b,P as p,b as u};
