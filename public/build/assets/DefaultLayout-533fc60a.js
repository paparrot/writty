import{T as y,o as s,c as r,b as t,e as x,v as M,u as h,n,t as v,d as g,K as C,r as m,B as z,F as w,g as i,C as B,i as $,a as j,O as H,A as f}from"./app-febfaeaf.js";const S=["onSubmit"],F={class:"mb-2"},N={class:"text-error"},V=t("div",{class:"form-control"},[t("button",{class:"btn btn-sm btn-primary w-full",type:"submit"},"Publish")],-1),L={__name:"PostForm",emits:["post-created"],setup(k,{emit:c}){const o=y({content:""}),d=async()=>{o.post(route("posts.store"),{onSuccess:()=>{c("post-created")}})};return(_,u)=>(s(),r("form",{class:"p-3",onSubmit:g(d,["prevent"])},[t("div",F,[x(t("textarea",{name:"content",onInput:u[0]||(u[0]=p=>h(o).errors.content=null),"onUpdate:modelValue":u[1]||(u[1]=p=>h(o).content=p),placeholder:"What's happen?",class:n([{"textarea-error":h(o).content.length>255||h(o).errors.content},"textarea textarea-bordered resize-none textarea-sm w-full"])},null,34),[[M,h(o).content]]),t("p",N,v(h(o).errors.content),1),t("span",{class:n(["text-gray-500 text-xs",{"text-red-500":h(o).content.length>255}])},v(h(o).content.length)+" / 255",3)]),V],40,S))}},P={class:"h-screen overflow-hidden flex gap-4 md:p-4"},D={class:"card card-bordered w-1/5 hidden md:block p-4"},A={class:"space-y-3"},I=["href"],O={key:0},T=["href"],U={key:1},W=["href"],q={key:0},E=["href"],K={class:""},R=["href"],G={class:"w-full md:w-3/5 overflow-y-scroll rounded"},J={class:"sticky top-0 z-10 backdrop-blur-xl w-full mb-4"},Q={class:"navbar flex justify-between shadow-md rounded-b"},X={class:"flex gap-3"},Y=["href"],Z=["href"],tt=f('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M9 12h12l-3 -3"></path><path d="M18 15l3 -3"></path></svg>',1),et=[tt],ot={class:"card card-bordered w-1/5 hidden md:block p-4"},st=t("h2",{class:"text-xl font-bold text-center mb-3"},"Latest authors",-1),rt={class:"space-y-3"},nt=["href"],lt={class:"w-full fixed bottom-0 md:hidden"},at={class:"menu flex justify-between menu-horizontal bg-base-200 rounded-t-box"},it=["href"],ht=f('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M10 12h4v4h-4z"></path></svg>',1),dt=[ht],ut=["href"],ct=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-search",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"}),t("path",{d:"M21 21l-6 -6"})],-1),pt=[ct],ft={key:0},wt=["href"],vt=f('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 12h6"></path><path d="M12 9v6"></path><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path></svg>',1),_t=[vt],bt={key:1},mt=["href"],gt=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-heart-filled",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z","stroke-width":"0",fill:"currentColor"})],-1),kt=[gt],yt=["href"],xt=f('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path></svg>',1),Mt=[xt],Ct={class:"flex items-center justify-between w-full"},zt=t("h2",{class:"font-bold text-2xl"},"Make new post",-1),Bt=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-x",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M18 6l-12 12"}),t("path",{d:"M6 6l12 12"})],-1),$t=[Bt],Ht={__name:"DefaultLayout",setup(k){var u,p,b;const c=C(),o=m((b=(p=(u=c.props)==null?void 0:u.auth)==null?void 0:p.user)==null?void 0:b.id);z(()=>{var e,l,a;o.value=(a=(l=(e=c.props)==null?void 0:e.auth)==null?void 0:l.user)==null?void 0:a.id});const d=m(!1),_=()=>{H.post(route("logout"))};return(e,l)=>(s(),r("div",P,[t("aside",D,[t("nav",null,[t("ul",A,[t("li",null,[t("a",{class:n([{"text-primary":e.route().current("home")},"btn btn-outline w-full"]),href:e.route("home")},"Home",10,I)]),o.value?(s(),r(w,{key:1},[o.value?(s(),r("li",q,[t("a",{class:n([{"text-primary":e.route().current("profile.edit")},"btn btn-outline w-full"]),href:e.route("profile.edit")},"Profile",10,E)])):i("",!0),t("li",K,[t("a",{class:n([{"text-primary":e.route().current("posts.favourites")},"btn btn-outline w-full"]),href:e.route("posts.favourites")},"Favourites",10,R)]),t("li",null,[o.value?(s(),r("button",{key:0,onClick:l[0]||(l[0]=a=>d.value=!0),class:"w-full btn btn-primary"},"New post ")):i("",!0)])],64)):(s(),r(w,{key:0},[o.value?i("",!0):(s(),r("li",O,[t("a",{class:n([{"text-primary":e.route().current("login")},"btn btn-outline w-full"]),href:e.route("login")}," Login ",10,T)])),o.value?i("",!0):(s(),r("li",U,[t("a",{class:n([{"text-primary":e.route().current("register")},"btn btn-outline w-full"]),href:e.route("register")}," Register ",10,W)]))],64))])])]),t("main",G,[t("header",J,[t("nav",Q,[t("div",X,[t("a",{class:n([{"text-primary":e.route().current("home")},"btn btn-ghost normal-case text-xl"]),href:e.route("home")}," Writty ",10,Y),o.value?(s(),r("a",{key:0,class:n([{"text-primary":e.route().current("posts.following")},"btn btn-ghost normal-case text-xl"]),href:e.route("posts.following")}," Following ",10,Z)):i("",!0)]),o.value?(s(),r("button",{key:0,onClick:_},et)):i("",!0)])]),B(e.$slots,"default")]),t("aside",ot,[st,t("ul",rt,[(s(!0),r(w,null,$(h(c).props.latestAuthors,a=>(s(),r("li",null,[t("a",{class:"block font-bold w-full rounded px-2 py-1 text-center bg-base-200",href:e.route("profile.show",{user:a})},"@"+v(a),9,nt)]))),256))])]),t("footer",lt,[t("ul",at,[t("li",null,[t("a",{href:e.route("home"),class:n({"text-primary":e.route().current("home")})},dt,10,it)]),t("li",null,[t("a",{class:n({"text-primary":e.route().current("posts.search")}),href:e.route("posts.search")},pt,10,ut)]),o.value?(s(),r("li",ft,[t("a",{class:n({"text-primary":e.route().current("posts.create")}),href:e.route("posts.create")},_t,10,wt)])):i("",!0),o.value?(s(),r("li",bt,[t("a",{class:n({"text-primary":e.route().current("posts.favourites")}),href:e.route("posts.favourites")},kt,10,mt)])):i("",!0),t("li",null,[t("a",{class:n({"text-primary":e.route().current("profile.edit")}),href:o.value?e.route("profile.edit"):e.route("login")},Mt,10,yt)])])]),d.value?(s(),r("div",{key:0,class:"absolute inset-0 bg-neutral-focus bg-opacity-95 z-20 grid place-items-center",onClick:l[4]||(l[4]=a=>d.value=!1)},[t("div",{onClick:l[3]||(l[3]=g(()=>{},["stop"])),class:"relative h-60 bg-white dark:bg-neutral card card-bordered p-4 rounded w-1/2 max-w-5xl"},[t("div",Ct,[zt,t("button",{onClick:l[1]||(l[1]=a=>d.value=!1),class:"btn btn-sm"},$t)]),j(L,{onPostCreated:l[2]||(l[2]=a=>d.value=!1)})])])):i("",!0)]))}};export{Ht as _,L as a};
