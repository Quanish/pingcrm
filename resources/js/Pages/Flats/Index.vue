<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Квартиры</h1>
    <div class="flats mb-12 flex">
	    <div class="flats_upper_panel">
	    	<select id="jk" name="jk">
			    <option value="Royal">Royal Aprtments</option>
			    <option value="Park">Park Residence</option>
			    <option value="BIIK">BIIK</option>
			    <option value="Jas">Jas Otau</option>
			    <option value="RoyalP">Royal Park</option>
			</select>
	    </div>
	    <div class="flats_upper_panel">
	    	<select id="blok" name="blok">
			    <option value="blok1">Блок 1</option>
			    <option value="blok2">Блок 2</option>
			    <option value="blok3">Блок 3</option>
			    <option value="blok4">Блок 4</option>
			    <option value="blok5">Блок 5</option>
			</select>
	    </div>
	    <div class="flats_upper_panel">
	    	<select id="blok" name="blok">
			    <option value="blok1">Все квартиры</option>
			    <option value="blok2">1</option>
			    <option value="blok3">2</option>
			    <option value="blok4">3</option>
			    <option value="blok5">4</option>
			</select>
	    </div>
    </div>
    <div class="flats mb-12">
    	<div class="flex justify-between">
    		<p class="flats_floor flats_text">Этаж</p>
	    	<p class="flats_text"><i class="fas fa-circle"></i>Бронь от руководства</p>
	    	<p class="flats_text">отправили клиента на кассу</p>
	    	<p class="flats_text">внес предоплату от начального взноса</p>
	    	<p class="flats_text">проданная квартира</p>
    	</div>
    	<br>
    	<div class="flex">    	
	    		<table class="flats_table">
				    <tr>
				    	<th><p class="flats_floor flats_text">12</p></th>
				        <td>2k 65.04 <br> K-3B<br> кв. №103</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №102</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №101</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №100</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №99</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №98</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №97</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №96</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №95</td>
				    </tr>
				    <tr>
				    	<th><p class="flats_floor flats_text">11</p></th>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №94</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №93</td>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №92</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №91</td>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №90</td>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №89</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №88</td>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №87</td>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №86</td>
				    </tr>
				    <tr>
				    	<th><p class="flats_floor flats_text">10</p></th>
				        <td>2k 65.04 <br> K-3B<br> кв. №85</td>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №84</td>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №83</td>
				        <td class="green">2k 65.04 <br> K-3B<br> кв. №82</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №81</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №80</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №79</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №78</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №77</td>
				    </tr>
				    <tr>
				    	<th><p class="flats_floor flats_text">9</p></th>
				        <td class="yellow">2k 65.04 <br> K-3B<br> кв. №76</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №75</td>
				        <td class="pink">2k 65.04 <br> K-3B<br> кв. №74</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №73</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №72</td>
				        <td class="pink">2k 65.04 <br> K-3B<br> кв. №71</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №70</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №69</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №68</td>
				    </tr>
				    <tr>
				    	<th><p class="flats_floor flats_text">8</p></th>
				        <td class="yellow">2k 65.04 <br> K-3B<br> кв. №67</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №66</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №65</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №64</td>
				        <td class="yellow">2k 65.04 <br> K-3B<br> кв. №63</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №62</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №61</td>
				        <td class="yellow">2k 65.04 <br> K-3B<br> кв. №60</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №59</td>
				    </tr>
				    <tr>
				    	<th><p class="flats_floor flats_text">7</p></th>
				        <td class="pink">2k 65.04 <br> K-3B<br> кв. №58</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №57</td>
				        <td class="pink">2k 65.04 <br> K-3B<br> кв. №56</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №55</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №54</td>
				        <td class="yellow">2k 65.04 <br> K-3B<br> кв. №53</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №52</td>
				        <td class="pink">2k 65.04 <br> K-3B<br> кв. №51</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №50</td>
				    </tr>
				    <tr>
				    	<th><p class="flats_floor flats_text">6</p></th>
				        <td>2k 65.04 <br> K-3B<br> кв. №49</td>
				        <td class="red">2k 65.04 <br> K-3B<br> кв. №48</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №47</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №46</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №45</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №44</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №43</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №42</td>
				        <td>2k 65.04 <br> K-3B<br> кв. №41</td>
				    </tr>
				</table>
	    		<br>
    	</div>
        
    </div>

  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Квартиры' },
  layout: Layout,
}
</script>
