import{T as c,o as u,c as w,a as d,u as t,w as _,F as f,Z as b,b as s,e as r,v as i,t as n,n as h,d as k}from"./app-a15ffb42.js";import{_ as v}from"./DefaultLayout-403aef36.js";const y=["onSubmit"],g=s("label",{for:"email"}," Email ",-1),x={class:"mt-2"},P={class:"mt-4"},S=s("label",{for:"password",class:"label"},"Password",-1),V={class:"mt-2"},q={class:"mt-4"},B=s("label",{for:"password_confirmation"},"Confirm Password",-1),C={class:"mt-2"},F={class:"flex items-center justify-end mt-4"},R=["disabled"],M={__name:"ResetPassword",props:{email:String,token:String},setup(p){const l=p,o=c({token:l.token,email:l.email,password:"",password_confirmation:""}),m=()=>{o.post(route("password.update"),{onFinish:()=>o.reset("password","password_confirmation")})};return(U,e)=>(u(),w(f,null,[d(t(b),{title:"Reset Password"}),d(v,null,{default:_(()=>[s("form",{onSubmit:k(m,["prevent"])},[s("div",null,[g,r(s("input",{id:"email","onUpdate:modelValue":e[0]||(e[0]=a=>t(o).email=a),type:"email",class:"input input-bordered mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,512),[[i,t(o).email]]),s("p",x,n(t(o).errors.email),1)]),s("div",P,[S,r(s("input",{id:"password","onUpdate:modelValue":e[1]||(e[1]=a=>t(o).password=a),type:"password",class:"input input-bordered mt-1 block w-full",required:"",autocomplete:"new-password"},null,512),[[i,t(o).password]]),s("p",V,n(t(o).errors.password),1)]),s("div",q,[B,r(s("input",{id:"password_confirmation","onUpdate:modelValue":e[2]||(e[2]=a=>t(o).password_confirmation=a),type:"password",class:"input input-bordered mt-1 block w-full",required:"",autocomplete:"new-password"},null,512),[[i,t(o).password_confirmation]]),s("p",C,n(t(o).errors.password_confirmation),1)]),s("div",F,[s("button",{class:h(["btn btn-primary",{"opacity-25":t(o).processing}]),disabled:t(o).processing}," Reset Password ",10,R)])],40,y)]),_:1})],64))}};export{M as default};
