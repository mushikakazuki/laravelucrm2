const nl2br = (str) => {
  str = str.replace(/\r\n/g, "<br />");
  str = str.replace(/(\n|\r)/g, "<br />");
  return str;
}

const toDayGet = () => {
  const today = new Date();
  const yyyy = today.getFullYear();
  const mm = ("0"+(today.getMonth()+1)).slice(-2);
  const dd = ("0"+today.getDate()).slice(-2);
  return yyyy+'-'+mm+'-'+dd;
}

export { nl2br, toDayGet}