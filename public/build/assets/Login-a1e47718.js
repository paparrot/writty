import{T as x,o as a,c as n,a as p,w as b,u as s,F as w,Z as h,b as t,t as i,g as d,d as g,e as m,v as _,n as u,h as y,f as v}from"./app-133c3f9d.js";import{_ as k}from"./DefaultLayout-9cabcf83.js";const V=t("title",null,"Log in",-1),B={class:"card card-bordered bg-base-100 max-w-xl mx-auto p-4"},C={key:0,class:"mb-4 font-medium text-sm text-green-600 dark:text-green-400"},N=["onSubmit"],S=t("label",{for:"email"},"Email",-1),F={key:0,class:"text-error"},L={class:"mt-4"},M=t("label",{for:"email"},"Password",-1),R={key:0,class:"text-error"},T={class:"block mt-4"},U={class:"flex items-center"},$=t("span",{class:"ml-2 text-sm text-gray-600 dark:text-gray-400"},"Remember me",-1),q={class:"text-sm py-4"},D=["href"],E={class:"flex items-center justify-end mt-4"},I=["disabled"],z={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(c){const e=x({email:"",password:"",remember:!1}),f=()=>{e.transform(l=>({...l,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(l,r)=>(a(),n(w,null,[p(s(h),null,{default:b(()=>[V]),_:1}),p(k,null,{default:b(()=>[t("div",B,[c.status?(a(),n("div",C,i(c.status),1)):d("",!0),t("form",{onSubmit:g(f,["prevent"])},[t("div",null,[S,m(t("input",{id:"email","onUpdate:modelValue":r[0]||(r[0]=o=>s(e).email=o),type:"email",class:u(["input input-bordered mt-1 block w-full",{"input-error":s(e).errors.email}]),onInput:r[1]||(r[1]=o=>s(e).errors.email=null),required:"",autofocus:"",autocomplete:"username"},null,34),[[_,s(e).email]]),s(e).errors.email?(a(),n("p",F,i(s(e).errors.email),1)):d("",!0)]),t("div",L,[M,m(t("input",{id:"password","onUpdate:modelValue":r[2]||(r[2]=o=>s(e).password=o),type:"password",onInput:r[3]||(r[3]=o=>s(e).errors.password=null),class:u([{"input-error":s(e).errors.password},"input input-bordered mt-1 block w-full"]),required:"",autocomplete:"current-password"},null,34),[[_,s(e).password]]),s(e).errors.password?(a(),n("p",R,i(s(e).errors.password),1)):d("",!0)]),t("div",T,[t("label",U,[m(t("input",{type:"checkbox",class:"checkbox","onUpdate:modelValue":r[4]||(r[4]=o=>s(e).remember=o),name:"remember"},null,512),[[y,s(e).remember]]),$])]),t("div",q,[t("a",{class:"text-primary",href:l.route("register")},"Register",8,D),v(", if you don't have account yet. ")]),t("div",E,[t("button",{class:u(["btn btn-primary btn-sm ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing}," Log in ",10,I)])],40,N)])]),_:1})],64))}};export{z as default};