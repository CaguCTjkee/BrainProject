<div class="mb-2">
    <label>Уровень образования</label>
    <select name="education-level[]" class="custom-select w-100">
        <option value="">Выберите уроверь образования</option>
        <option value="1" {{if $edu.level == 1}}selected{{/if}}>высшее</option>
        <option value="2" {{if $edu.level == 2}}selected{{/if}}>неоконченное высшее</option>
        <option value="3" {{if $edu.level == 3}}selected{{/if}}>средне-специальное</option>
        <option value="4" {{if $edu.level == 4}}selected{{/if}}>среднее</option>
    </select>
</div>
<div class="mb-2">
    <label>Название вуза</label>
    <input type="text" name="education-school[]" class="form-control"
           value="{{if !empty($edu.school)}}{{$edu.school}}{{/if}}">
</div><label>Город</label><input type="text" name="education-city[]" class="form-control"
                                 value="{{if !empty($edu.city)}}{{$edu.city}}{{/if}}">
<div class="mb-2">
    <label>Факультет, Специальность</label>
    <input type="text" name="education-speciality[]" class="form-control"
           value="{{if !empty($edu.speciality)}}{{$edu.speciality}}{{/if}}">
</div>
<div class="mb-2">
    <label>Год окончания</label>
    <select name="education-year[]" class="custom-select w-100">
        <option value="">Год</option>
        <option value="2020" {{if $edu.year == "2020"}}selected{{/if}}>2020</option>
        <option value="2019" {{if $edu.year == "2019"}}selected{{/if}}>2019</option>
        <option value="2018" {{if $edu.year == "2018"}}selected{{/if}}>2018</option>
        <option value="2017" {{if $edu.year == "2017"}}selected{{/if}}>2017</option>
        <option value="2016" {{if $edu.year == "2016"}}selected{{/if}}>2016</option>
        <option value="2015" {{if $edu.year == "2015"}}selected{{/if}}>2015</option>
        <option value="2014" {{if $edu.year == "2014"}}selected{{/if}}>2014</option>
        <option value="2013" {{if $edu.year == "2013"}}selected{{/if}}>2013</option>
        <option value="2012" {{if $edu.year == "2012"}}selected{{/if}}>2012</option>
        <option value="2011" {{if $edu.year == "2011"}}selected{{/if}}>2011</option>
        <option value="2010" {{if $edu.year == "2010"}}selected{{/if}}>2010</option>
        <option value="2009" {{if $edu.year == "2009"}}selected{{/if}}>2009</option>
        <option value="2008" {{if $edu.year == "2008"}}selected{{/if}}>2008</option>
        <option value="2007" {{if $edu.year == "2007"}}selected{{/if}}>2007</option>
        <option value="2006" {{if $edu.year == "2006"}}selected{{/if}}>2006</option>
        <option value="2005" {{if $edu.year == "2005"}}selected{{/if}}>2005</option>
        <option value="2004" {{if $edu.year == "2004"}}selected{{/if}}>2004</option>
        <option value="2003" {{if $edu.year == "2003"}}selected{{/if}}>2003</option>
        <option value="2002" {{if $edu.year == "2002"}}selected{{/if}}>2002</option>
        <option value="2001" {{if $edu.year == "2001"}}selected{{/if}}>2001</option>
        <option value="2000" {{if $edu.year == "2000"}}selected{{/if}}>2000</option>
        <option value="1999" {{if $edu.year == "1999"}}selected{{/if}}>1999</option>
        <option value="1998" {{if $edu.year == "1998"}}selected{{/if}}>1998</option>
        <option value="1997" {{if $edu.year == "1997"}}selected{{/if}}>1997</option>
        <option value="1996" {{if $edu.year == "1996"}}selected{{/if}}>1996</option>
        <option value="1995" {{if $edu.year == "1995"}}selected{{/if}}>1995</option>
        <option value="1994" {{if $edu.year == "1994"}}selected{{/if}}>1994</option>
        <option value="1993" {{if $edu.year == "1993"}}selected{{/if}}>1993</option>
        <option value="1992" {{if $edu.year == "1992"}}selected{{/if}}>1992</option>
        <option value="1991" {{if $edu.year == "1991"}}selected{{/if}}>1991</option>
        <option value="1990" {{if $edu.year == "1990"}}selected{{/if}}>1990</option>
        <option value="1989" {{if $edu.year == "1989"}}selected{{/if}}>1989</option>
        <option value="1988" {{if $edu.year == "1988"}}selected{{/if}}>1988</option>
        <option value="1987" {{if $edu.year == "1987"}}selected{{/if}}>1987</option>
        <option value="1986" {{if $edu.year == "1986"}}selected{{/if}}>1986</option>
        <option value="1985" {{if $edu.year == "1985"}}selected{{/if}}>1985</option>
        <option value="1984" {{if $edu.year == "1984"}}selected{{/if}}>1984</option>
        <option value="1983" {{if $edu.year == "1983"}}selected{{/if}}>1983</option>
        <option value="1982" {{if $edu.year == "1982"}}selected{{/if}}>1982</option>
        <option value="1981" {{if $edu.year == "1981"}}selected{{/if}}>1981</option>
        <option value="1980" {{if $edu.year == "1980"}}selected{{/if}}>1980</option>
        <option value="1979" {{if $edu.year == "1979"}}selected{{/if}}>1979</option>
        <option value="1978" {{if $edu.year == "1978"}}selected{{/if}}>1978</option>
        <option value="1977" {{if $edu.year == "1977"}}selected{{/if}}>1977</option>
        <option value="1976" {{if $edu.year == "1976"}}selected{{/if}}>1976</option>
        <option value="1975" {{if $edu.year == "1975"}}selected{{/if}}>1975</option>
        <option value="1974" {{if $edu.year == "1974"}}selected{{/if}}>1974</option>
        <option value="1973" {{if $edu.year == "1973"}}selected{{/if}}>1973</option>
        <option value="1972" {{if $edu.year == "1972"}}selected{{/if}}>1972</option>
        <option value="1971" {{if $edu.year == "1971"}}selected{{/if}}>1971</option>
        <option value="1970" {{if $edu.year == "1970"}}selected{{/if}}>1970</option>
        <option value="1969" {{if $edu.year == "1969"}}selected{{/if}}>1969</option>
        <option value="1968" {{if $edu.year == "1968"}}selected{{/if}}>1968</option>
        <option value="1967" {{if $edu.year == "1967"}}selected{{/if}}>1967</option>
        <option value="1966" {{if $edu.year == "1966"}}selected{{/if}}>1966</option>
        <option value="1965" {{if $edu.year == "1965"}}selected{{/if}}>1965</option>
        <option value="1964" {{if $edu.year == "1964"}}selected{{/if}}>1964</option>
        <option value="1963" {{if $edu.year == "1963"}}selected{{/if}}>1963</option>
        <option value="1962" {{if $edu.year == "1962"}}selected{{/if}}>1962</option>
        <option value="1961" {{if $edu.year == "1961"}}selected{{/if}}>1961</option>
        <option value="1960" {{if $edu.year == "1960"}}selected{{/if}}>1960</option>
        <option value="1959" {{if $edu.year == "1959"}}selected{{/if}}>1959</option>
        <option value="1958" {{if $edu.year == "1958"}}selected{{/if}}>1958</option>
        <option value="1957" {{if $edu.year == "1957"}}selected{{/if}}>1957</option>
        <option value="1956" {{if $edu.year == "1956"}}selected{{/if}}>1956</option>
        <option value="1955" {{if $edu.year == "1955"}}selected{{/if}}>1955</option>
        <option value="1954" {{if $edu.year == "1954"}}selected{{/if}}>1954</option>
        <option value="1953" {{if $edu.year == "1953"}}selected{{/if}}>1953</option>
        <option value="1952" {{if $edu.year == "1952"}}selected{{/if}}>1952</option>
        <option value="1951" {{if $edu.year == "1951"}}selected{{/if}}>1951</option>
        <option value="1950" {{if $edu.year == "1950"}}selected{{/if}}>1950</option>
        <option value="1949" {{if $edu.year == "1949"}}selected{{/if}}>1949</option>
        <option value="1948" {{if $edu.year == "1948"}}selected{{/if}}>1948</option>
        <option value="1947" {{if $edu.year == "1947"}}selected{{/if}}>1947</option>
        <option value="1946" {{if $edu.year == "1946"}}selected{{/if}}>1946</option>
        <option value="1945" {{if $edu.year == "1945"}}selected{{/if}}>1945</option>
        <option value="1944" {{if $edu.year == "1944"}}selected{{/if}}>1944</option>
        <option value="1943" {{if $edu.year == "1943"}}selected{{/if}}>1943</option>
        <option value="1942" {{if $edu.year == "1942"}}selected{{/if}}>1942</option>
        <option value="1941" {{if $edu.year == "1941"}}selected{{/if}}>1941</option>
        <option value="1940" {{if $edu.year == "1940"}}selected{{/if}}>1940</option>
        <option value="1939" {{if $edu.year == "1939"}}selected{{/if}}>1939</option>
        <option value="1938" {{if $edu.year == "1938"}}selected{{/if}}>1938</option>
        <option value="1937" {{if $edu.year == "1937"}}selected{{/if}}>1937</option>
    </select>
</div>