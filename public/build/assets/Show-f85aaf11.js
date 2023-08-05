import{K as U,T as V,o as r,c as n,a as w,w as v,u as t,F as N,Z as C,b as e,t as i,d as S,e as u,v as p,g as d,n as y}from"./app-133c3f9d.js";import{_ as B}from"./DefaultLayout-9cabcf83.js";const D=e("title",null,"Profile",-1),F=e("h1",{class:"text-2xl text-center mb-2 font-bold"},"Profile information",-1),P={key:0,class:"avatar w-full my-4"},E={class:"w-16 mx-auto rounded-full"},M=["src"],T={key:1,class:"avatar placeholder w-full my-4"},z={class:"bg-neutral-focus text-neutral-content rounded-full w-16 mx-auto"},I={class:"font-bold text-2xl"},K={class:"card card-bordered p-4 mx-auto max-w-xl"},Z=["onSubmit"],$=e("label",{for:"email",class:"label"}," Email ",-1),j={key:0,class:"text-error"},q=e("label",{for:"name",class:"label"}," Name ",-1),A={key:0,class:"text-error"},G=e("label",{for:"nickname",class:"label"}," Nickname ",-1),H={key:0,class:"text-error"},J=e("label",{class:"label",for:"photo"}," Profile photo ",-1),L=e("button",{type:"submit",class:"w-full btn btn-primary"}," Update ",-1),X={__name:"Show",setup(O){var m,c,_,f,h,b,x,k;const s=U(),o=V({email:(c=(m=s.props.auth)==null?void 0:m.user)==null?void 0:c.email,name:(f=(_=s.props.auth)==null?void 0:_.user)==null?void 0:f.name,nickname:(b=(h=s.props.auth)==null?void 0:h.user)==null?void 0:b.nickname,photo:(k=(x=s.props.auth)==null?void 0:x.user)==null?void 0:k.profile_photo_path}),g=()=>{o.post(route("profile.update",{user:s.props.auth.user.id}),{forceFormData:!0})};return(Q,a)=>(r(),n(N,null,[w(t(C),null,{default:v(()=>[D]),_:1}),w(B,null,{default:v(()=>[F,t(s).props.auth.user.profile_photo_path?(r(),n("div",P,[e("div",E,[e("img",{src:t(s).props.auth.user.profile_photo_path,alt:"page.props.auth.user.nickname"},null,8,M)])])):(r(),n("div",T,[e("div",z,[e("span",I,i(t(s).props.auth.user.email[0].toUpperCase()),1)])])),e("div",K,[e("form",{onSubmit:S(g,["prevent"]),class:"space-y-4"},[e("div",null,[$,u(e("input",{id:"email",type:"text",name:"email",class:"w-full input input-bordered","onUpdate:modelValue":a[0]||(a[0]=l=>t(o).email=l)},null,512),[[p,t(o).email]]),t(o).errors.email?(r(),n("p",j,i(t(o).errors.email),1)):d("",!0)]),e("div",null,[q,u(e("input",{class:y([{"input-error":t(o).errors.name},"input input-bordered w-full"]),id:"name",type:"text","onUpdate:modelValue":a[1]||(a[1]=l=>t(o).name=l)},null,2),[[p,t(o).name]]),t(o).errors.name?(r(),n("p",A,i(t(o).errors.name),1)):d("",!0)]),e("div",null,[G,u(e("input",{class:y([{"input-error":t(o).errors.nickname},"input input-bordered w-full"]),id:"name",type:"text","onUpdate:modelValue":a[2]||(a[2]=l=>t(o).nickname=l)},null,2),[[p,t(o).nickname]]),t(o).errors.nickname?(r(),n("p",H,i(t(o).errors.nickname),1)):d("",!0)]),e("div",null,[J,e("input",{type:"file",onInput:a[3]||(a[3]=l=>t(o).photo=l.target.files[0]),id:"photo",class:"file-input file-input-bordered w-full max-w-xs"},null,32)]),L],40,Z)])]),_:1})],64))}};export{X as default};