const imgClickAreaArray = document.querySelectorAll(".imgClickArea");
const imgArray = document.querySelectorAll(".img");
const slideShow__img = document.getElementById("slideShow__img");
const closeButton = document.getElementById("closeButton");
const slideShow = document.getElementById("slideShow");
let width = 0;
let height = 0;
let imgPass = "";

window.onload = function () {
  screenSize();
  slideShow.style.left = -width + "px";
  console.log(-width);
};

function screenSize() {
  width = slideShow.clientWidth;
  height = slideShow.clientHeight;
  console.log(width);
  console.log(height);
}

for (let i = 0; i < imgClickAreaArray.length; i++) {
  imgClickAreaArray[i].addEventListener("click", (event) => {
    const imgClickArrayId = event.target.id;
    const imgClickArray = document.getElementById(imgClickArrayId);
    console.log(imgClickArray);
    const img_element = imgClickArray.querySelector(".img");
    console.log(img_element);
    imgPass = img_element.getAttribute("src");

    console.log(imgPass);
    slideShow__img.src = imgPass;
  });

  imgClickAreaArray[i].addEventListener("click", (event) => {
    onresize();
    screenSize();
    slideShow.classList.add("fadeIn");
    slideShow.classList.remove("fadeout");
    slideShow.style.left = 0 + "px";
  });
}

for (let i = 0; i < imgArray.length; i++) {
  imgArray[i].addEventListener("click", (event) => {
    const imgArrayId = event.target.id;
    const img_element = document.getElementById(imgArrayId);
    console.log(img_element);
    imgPass = img_element.getAttribute("src");

    console.log(imgPass);
    slideShow__img.src = imgPass;
  });

  imgArray[i].addEventListener("click", (event) => {
    onresize();
    screenSize();
    slideShow.classList.add("fadeIn");
    slideShow.classList.remove("fadeout");
    slideShow.style.left = 0 + "px";
  });
}

function onresize() {
  //画像の外枠
  const margin = 50;

  //画像のサイズを取得
  const iwidth = slideShow__img.width;
  const iheight = slideShow__img.height;

  //ウィンドウのサイズを取得
  let wwidth = window.innerWidth;
  let wheight = window.innerHeight;

  //上下左右の外枠サイズ分を考慮
  wwidth -= margin * 2;
  wheight -= margin * 2;

  // ウィンドウサイズに対する画像サイズの比率を取得
  var wratio = iwidth / wwidth;
  var hratio = iheight / wheight;

  // 新しい画像サイズを計算
  var newwidth = iwidth;
  var newheight = iheight;
  if (wratio > 1 && hratio <= 1) {
    // 幅がはみ出る場合、幅を基準に縮める
    newwidth = iwidth / wratio;
    newheight = iheight / wratio;
  } else if (wratio <= 1 && hratio > 1) {
    // 高さがはみ出る場合、高さを基準に縮める
    newwidth = iwidth / hratio;
    newheight = iheight / hratio;
  } else if (wratio > 1 && hratio > 1) {
    // 両方はみ出る場合、幅・高さの大きいほうを基準に縮める
    if (wratio < hratio) {
      newwidth = iwidth / hratio;
      newheight = iheight / hratio;
    } else {
      newwidth = iwidth / wratio;
      newheight = iheight / wratio;
    }
  }
  //画像をリサイズ
  slideShow__img.style.width = newwidth;
  slideShow__img.style.height = newheight;
}

closeButton.addEventListener("click", () => {
  screenSize();
  slideShow.style.left = -width + "px";
  slideShow.classList.remove("fadeIn");
  slideShow.classList.add("fadeout");
});
