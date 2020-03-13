
var ap5 = new APlayer({
    element: document.getElementById('player5'),
    narrow: false,
    autoplay: false,
    showlrc: 3,
    mutex: true,
    theme: '#ad7a86',
    mode: 'random',
    listmaxheight: '8em',
    music: [
        {
            title: '觅香',
            author: '栗先达',
            url: 'http://music.163.com/song/media/outer/url?id=507815173.mp3',
            pic: 'http://p1.music.126.net/CBEj7khu4CZg5F2D0RSCpw==/109951163028875013.jpg?param=130y130',
            lrc: "./lrc/mx.lrc"
        },
        {
            title: '保护色',
            author: '赵钶',
            url: 'http://music.163.com/song/media/outer/url?id=487190794.mp3',
            pic: 'http://p1.music.126.net/AdQ3bBo2lArHkvdra4v_uQ==/18732379604385413.jpg?param=130y130',
            lrc: "./lrc/bhs.lrc"
        },
        {
            title: '清白之年',
            author: '王珞丹/朴树',
            url: 'http://music.163.com/song/media/outer/url?id=487590187.mp3',
            pic: 'http://p1.music.126.net/W_5XiCv3rGS1-J7EXpHSCQ==/18885211718782327.jpg?param=130y130',
            lrc: "./lrc/qbzn.lrc"
        }
    ]
});