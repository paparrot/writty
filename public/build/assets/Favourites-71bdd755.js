import{u as n,P as u,p}from"./PostList-c91d252e.js";import{m as l,K as c,o as _,c as m,a as e,w as a,u as o,F as i,Z as d,b as f}from"./app-15041f97.js";import{_ as P}from"./DefaultLayout-c1194746.js";const g=f("title",null,"Your favourites posts",-1),x={__name:"Favourites",props:{posts:{type:Array,required:!0}},setup(r){const{posts:s}=r,t=n();return l(()=>{t.setPosts(s.data),t.setCurrentPage(s.meta.current_page),t.setLastPage(s.meta.last_page)}),c(),(B,L)=>(_(),m(i,null,[e(o(d),null,{default:a(()=>[g]),_:1}),e(P,null,{default:a(()=>[e(u,{posts:o(t).posts,onLoadMorePosts:o(p).loadMorePosts},null,8,["posts","onLoadMorePosts"])]),_:1})],64))}};export{x as default};