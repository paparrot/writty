import{T as y,o as n,c as l,b as t,e as x,v as M,u as i,n as s,t as v,d as g,K as z,r as _,A as C,F as w,g as h,B,i as $,a as j,O as H,z as f}from"./app-f82d25fa.js";const S=["onSubmit"],F={class:"mb-2"},N={class:"text-error"},V=t("div",{class:"form-control"},[t("button",{class:"btn btn-sm btn-primary w-full",type:"submit"},"Publish")],-1),L={__name:"PostForm",emits:["post-created"],setup(k,{emit:c}){const o=y({content:""}),d=async()=>{o.post(route("posts.store"),{onSuccess:()=>{c("post-created")}})};return(b,u)=>(n(),l("form",{class:"p-3",onSubmit:g(d,["prevent"])},[t("div",F,[x(t("textarea",{name:"content",onInput:u[0]||(u[0]=p=>i(o).errors.content=null),"onUpdate:modelValue":u[1]||(u[1]=p=>i(o).content=p),placeholder:"What's happen?",class:s([{"textarea-error":i(o).content.length>255||i(o).errors.content},"textarea textarea-bordered resize-none textarea-sm w-full"])},null,34),[[M,i(o).content]]),t("p",N,v(i(o).errors.content),1),t("span",{class:s(["text-gray-500 text-xs",{"text-red-500":i(o).content.length>255}])},v(i(o).content.length)+" / 255",3)]),V],40,S))}},P={class:"h-screen overflow-hidden flex gap-4 md:p-4"},D={class:"card card-bordered w-1/5 hidden md:block p-4"},A={class:"space-y-3"},I=["href"],O=["href"],T=["href"],U=["href"],W=["href"],q=["href"],E={class:"w-full md:w-3/5 overflow-y-scroll rounded"},K={class:"sticky top-0 z-10 backdrop-blur-xl w-full mb-4"},R={class:"navbar flex justify-between shadow-md rounded-b"},G={class:"flex gap-3"},J=["href"],Q=["href"],X=f('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M9 12h12l-3 -3"></path><path d="M18 15l3 -3"></path></svg>',1),Y=[X],Z={class:"card card-bordered w-1/5 hidden md:block p-4"},tt=t("h2",{class:"text-xl font-bold text-center mb-3"},"Latest authors",-1),et={class:"space-y-3"},ot=["href"],st={class:"w-full fixed bottom-0 md:hidden"},rt={class:"menu flex justify-between menu-horizontal bg-base-200 rounded-t-box"},nt=["href"],lt=f('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M10 12h4v4h-4z"></path></svg>',1),at=[lt],it=["href"],ht=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-search",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"}),t("path",{d:"M21 21l-6 -6"})],-1),dt=[ht],ut={key:0},ct=["href"],pt=f('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 12h6"></path><path d="M12 9v6"></path><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path></svg>',1),ft=[pt],wt={key:1},vt=["href"],bt=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-heart-filled",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z","stroke-width":"0",fill:"currentColor"})],-1),mt=[bt],_t=["href"],gt=f('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path></svg>',1),kt=[gt],yt={class:"flex items-center justify-between w-full"},xt=t("h2",{class:"font-bold text-2xl"},"Make new post",-1),Mt=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"icon icon-tabler icon-tabler-x",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z",fill:"none"}),t("path",{d:"M18 6l-12 12"}),t("path",{d:"M6 6l12 12"})],-1),zt=[Mt],Bt={__name:"DefaultLayout",setup(k){var u,p,m;const c=z(),o=_((m=(p=(u=c.props)==null?void 0:u.auth)==null?void 0:p.user)==null?void 0:m.id);C(()=>{var e,r,a;o.value=(a=(r=(e=c.props)==null?void 0:e.auth)==null?void 0:r.user)==null?void 0:a.id});const d=_(!1),b=()=>{H.post(route("logout"))};return(e,r)=>(n(),l("div",P,[t("aside",D,[t("nav",null,[t("ul",A,[t("li",null,[t("a",{class:s([{"text-primary":e.route().current("home")},"btn btn-outline w-full"]),href:e.route("home")},"Home",10,I)]),o.value?h("",!0):(n(),l(w,{key:0},[t("li",null,[t("a",{class:s([{"text-primary":e.route().current("login")},"btn btn-outline w-full"]),href:e.route("login")}," Login ",10,O)]),t("li",null,[t("a",{class:s([{"text-primary":e.route().current("register")},"btn btn-outline w-full"]),href:e.route("register")}," Register ",10,T)])],64)),t("li",null,[t("a",{class:s([{"text-primary":e.route().current("posts.search")},"btn btn-outline w-full"]),href:e.route("posts.search")}," Search ",10,U)]),o.value?(n(),l(w,{key:1},[t("li",null,[t("a",{class:s([{"text-primary":e.route().current("profile.edit")},"btn btn-outline w-full"]),href:e.route("profile.edit")},"Profile",10,W)]),t("li",null,[t("a",{class:s([{"text-primary":e.route().current("posts.favourites")},"btn btn-outline w-full"]),href:e.route("posts.favourites")},"Favourites",10,q)]),t("li",null,[o.value?(n(),l("button",{key:0,onClick:r[0]||(r[0]=a=>d.value=!0),class:"w-full btn btn-primary"},"New post ")):h("",!0)])],64)):h("",!0)])])]),t("main",E,[t("header",K,[t("nav",R,[t("div",G,[t("a",{class:s([{"text-primary":e.route().current("home")},"btn btn-ghost normal-case text-xl"]),href:e.route("home")}," Writty ",10,J),o.value?(n(),l("a",{key:0,class:s([{"text-primary":e.route().current("posts.following")},"btn btn-ghost normal-case text-xl"]),href:e.route("posts.following")}," Following ",10,Q)):h("",!0)]),o.value?(n(),l("button",{key:0,onClick:b},Y)):h("",!0)])]),B(e.$slots,"default")]),t("aside",Z,[tt,t("ul",et,[(n(!0),l(w,null,$(i(c).props.latestAuthors,a=>(n(),l("li",null,[t("a",{class:"block font-bold w-full rounded px-2 py-1 text-center bg-base-200",href:e.route("profile.show",{user:a})},"@"+v(a),9,ot)]))),256))])]),t("footer",st,[t("ul",rt,[t("li",null,[t("a",{href:e.route("home"),class:s({"text-primary":e.route().current("home")})},at,10,nt)]),t("li",null,[t("a",{class:s({"text-primary":e.route().current("posts.search")}),href:e.route("posts.search")},dt,10,it)]),o.value?(n(),l("li",ut,[t("a",{class:s({"text-primary":e.route().current("posts.create")}),href:e.route("posts.create")},ft,10,ct)])):h("",!0),o.value?(n(),l("li",wt,[t("a",{class:s({"text-primary":e.route().current("posts.favourites")}),href:e.route("posts.favourites")},mt,10,vt)])):h("",!0),t("li",null,[t("a",{class:s({"text-primary":e.route().current("profile.edit")}),href:o.value?e.route("profile.edit"):e.route("login")},kt,10,_t)])])]),d.value?(n(),l("div",{key:0,class:"absolute inset-0 bg-neutral-focus bg-opacity-95 z-20 grid place-items-center",onClick:r[4]||(r[4]=a=>d.value=!1)},[t("div",{onClick:r[3]||(r[3]=g(()=>{},["stop"])),class:"relative h-60 bg-white dark:bg-neutral card card-bordered p-4 rounded w-1/2 max-w-5xl"},[t("div",yt,[xt,t("button",{onClick:r[1]||(r[1]=a=>d.value=!1),class:"btn btn-sm"},zt)]),j(L,{onPostCreated:r[2]||(r[2]=a=>d.value=!1)})])])):h("",!0)]))}};export{Bt as _,L as a};
