<?php

	switch ($table_id) {
		case "people":
			$identifier = "person";
			break;
		case "matches":
			$identifier = "match";
			break;
		case "hall_teams":
			$identifier = "hall_team";
			break;
		case "continents":
			$identifier = "continent";
			break;
		case "countries":
			$identifier = "country";
			break;
		case "teams":
			$identifier = "team";
			break;
		case "competitions":
			$identifier = "competition";
			break;
		case "tournaments":
			$identifier = "tournament";
			break;
		case "stories":
			$identifier = "story";
			break;
		case "dream_teams":
			$identifier = "dream_team";
			break;
		case "polls":
			$identifier = "poll";
			break;
		case "people_votes":
			$identifier = "person_vote";
			break;
		case "tables":
			$identifier = "table";
			break;
		case "news":
			$identifier = "news";
			break;
		case "tags":
			$identifier = "tag";
			break;
		case "people_tags":
			$identifier = "person_tag";
			break;
		default:
			$identifier = "person";
	}
	
?>
