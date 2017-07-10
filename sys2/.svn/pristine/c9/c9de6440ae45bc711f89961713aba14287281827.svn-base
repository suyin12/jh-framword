
var arrText = new Array(2);
var arrValue = new Array(arrText.length);

function objSetOption(select1, select2, select3) {
    this.select1 = select1;
    this.select2 = select2;
    this.select3 = select3;
}

arrText[0]= new objSetOption("因公:社会保险", "交通事故:交通事故,意外事故:意外事故", "工伤认定申请资料:工伤认定申请资料,网上申报:网上申报,窗口受理:窗口受理,资料审核:资料审核,认定书下达:认定书下达,治疗结束，办理费用报销:治疗结束，办理费用报销,结案:结案");
arrText[1] = new objSetOption("非因公:商业保险", "--无--:", "事故登记:事故登记,治疗期结束，递交相关申报资料:治疗期结束，递交相关申报资料,审批通过，保险公司赔付相关费用:审批通过，保险公司赔付相关费用,结案:结案");

function select(sValue1, sValue2, sValue3) {
    var eltSelect1 = document.myform.classid;
    var eltSelect2 = document.myform.suid;
    var eltSelect3 = document.myform.gid;
    var arrSelect1, arrSelect2, arrSelect3;
    var arrData1, arrData2, arrData3;
    with(eltSelect1) {
        var strSelect = options[selectedIndex].value;
    }
    for(i = 0;i < arrText.length;i ++) {
        arrSelect1 = arrText[i].select1;
        arrData1 = arrSelect1.split(":");
        if (arrData1[1] == strSelect) {
            arrSelect2 = (arrText[i].select2).split(",");
            for(j = 0;j < arrSelect2.length;j++) {
                arrData2 = arrSelect2[j].split(":");
                with(eltSelect2) {
                    length = arrSelect2.length;
                    options[j].text = arrData2[0];
                    options[j].value = arrData2[1];
                    if (arrData2[1] == sValue2) {
                        options[j].selected = true;
                    }
                }
            }
            arrSelect3 = (arrText[i].select3).split(",");
            for(j = 0;j < arrSelect3.length;j++) {
                arrData3 = arrSelect3[j].split(":");
                with(eltSelect3) {
                    length = arrSelect3.length;
                    options[j].text = arrData3[0];
                    options[j].value = arrData3[1];
                    if (arrData3[1] == sValue3) {
                        options[j].selected = true;
                    }
                }
            }
            break;
        }
    }
}

function init(sValue1, sValue2, sValue3) {
    var eltSelect1 = document.myform.classid;
    var eltSelect2 = document.myform.suid;
    var eltSelect3 = document.myform.gid;
    var arrSelect1, arrSelect2, arrSelect3;
    var arrData1, arrData2, arrData3;
    if (eltSelect1 != undefined && eltSelect2 != undefined && eltSelect3 != undefined) {
        with(eltSelect2) {
            arrSelect2 = (arrText[0].select2).split(",");
            length = arrSelect2.length;
            for(i = 0;i < length;i ++) {
                arrData2 = arrSelect2[i].split(":");
                options[i].text = arrData2[0];
                options[i].value = arrData2[1];
            }
        }
        with(eltSelect3) {
            arrSelect3 = (arrText[0].select3).split(",");
            length = arrSelect3.length;
            for(i = 0;i < length;i ++) {
                arrData3 = arrSelect3[i].split(":");
                options[i].text = arrData3[0];
                options[i].value = arrData3[1];
            }
        }
        with(eltSelect1) {
            length = arrText.length;
            for(i = 0;i < arrText.length;i ++) {
                arrSelect1 = arrText[i].select1;
                arrData1 = arrSelect1.split(":");
                options[i].text = arrData1[0];
                options[i].value = arrData1[1];
                if (arrData1[1] == sValue1) {
                    options[i].selected = true;
                    select("", sValue2, sValue3);
                }
            }
        }
    }
}

//init();
//默认初始化

init("2", "值b2_1", "值b3_2");
//更改后默认初始化